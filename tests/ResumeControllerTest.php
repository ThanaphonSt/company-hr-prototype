<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;

class ResumeControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $company;
    protected $subjob;
    protected $tambon;
    protected $resume;
    protected $job;
    protected $viewerLog;
    protected $ctr;

    protected function setup()
    {

        parent::setup();

        $this->company = factory(App\Company::class)->create()->fresh();
    
        $this->tambon = factory(App\Tambon::class)
                ->create([
                    'T_CODE' => '2',
                    'P_CODE' => '6'
                ])->fresh();

        $this->resume = factory(App\Resume::class)
                ->create(['TAMBONCODE' => '$tambon->T_CODE'])->fresh();

        $this->createJob();

        $this->viewerLog = factory(App\ViewerLog::class)
                ->create([
                    'JobCode'       => $this->job->RunningNumber, 
                    'CompanyCode' => $this->company->RunningNumber,
                    'Code'        => $this->resume->RunningNumber,
                ])->fresh();

        $this->ctr = factory(App\CTR::class)
                ->create(['JobCode' => $this->job->RunningNumber])->fresh();
    }

    protected function createJob()
    {
        $this->subjob = factory(App\SubJobType::class)->create()->fresh();

        $this->job = factory(App\Job::class)
                ->create([
                    'CompanyCode' => $this->company->RunningNumber,
                    'SubJobType' => $this->subjob->Code,
                    'TAMBONCODE' => $this->tambon->T_CODE
                ])->fresh(); 
    }

    public function testShow_ResumeDetail()
    {

       $app = factory(App\ApplicationDataAnalyzer::class)
            ->create([
                'JobCode'    => $this->job->RunningNumber,
                'ResumeCode' => $this->resume->RunningNumber,
                'CompanyCode' => $this->company->RunningNumber,
            ])->fresh();

        $jobs = $this->company
            ->jobs()
            ->online()
            ->get();

        $bindings = [
            ['company' => $this->company],
            ['jobs'    => $jobs],
            ['resume'  => $this->resume],
            
         ];

        $this->get('/company/' . $this->company->RunningNumber . '/resume/' . $this->resume->RunningNumber)
            ->assertViewHasAll($bindings);
    }
    public function testResumeContainer()
    {

        $jobs = $this->company
            ->jobs()
            ->online()
            ->get();

        $active = 'a' . $this->job->RunningNumber;


        $bindings = [
            ['company' => $this->company],
            ['jobs'    => $jobs],
            ['job'  => $this->job],
            ['active'  => $active],
         ];

        $this->get('/company/' . $this->company->RunningNumber . '/job/' . $this->job->RunningNumber . '/resumes')
            ->assertViewHasAll($bindings);
    }

    public function testResumeList()
    {
       
        $action = $this->viewerLog->Action;

        $resumes = $this->viewerLog->with('resumes')
            ->ofJobCode($this->job->RunningNumber)
            ->ofPreviousDay(15)
            ->ofAction($action)
            ->orderBy('CreateDate', 'DESC')
            ->paginate(20);

       $expact = ['html' => View::make(
            'companyHR.resumesList', 
            [ 
                'resumes' => $resumes,
                'action'  => $action,
                'company' => $this->company->RunningNumber,
            ]
        )->render()];

        $this->get('/company/' . $this->company->RunningNumber . '/job/' . $this->job->RunningNumber . '/' . $this->viewerLog->Action)
             ->seeJsonEquals($expact);
    }

     public function testGetprovince_JobDetail()
    {  
       $province_name = $this->tambon->ofProvince($this->tambon->P_CODE)->first()->PROVINCE_THAI;

        
        
        $expect = array('province' => $province_name);

        $this->get('/recommend/'. $this->tambon->P_CODE)->seeJsonEquals($expect);
    }


    public function testGenChart()
    {
        $app = factory(App\ApplicationDataAnalyzer::class)
            ->create([
                'ResumeCode' => $this->resume->RunningNumber,
                'JobCode'    => $this->job->RunningNumber,
                'CompanyCode' => $this->company->RunningNumber,
            ])->fresh();

        $chart = $app->select( DB::raw('count(*) as counter,JobType'))
            ->ofPreviousDay(15)
            ->ofResumeCode($this->resume->RunningNumber)
            ->groupBy('JobType')
            ->get();


        $expect = ['chart' => $chart->toArray()];

        $this->get('/resume/' . $this->resume->RunningNumber . '/genChart')
        ->seeJsonEquals($expect);

    }

    public function testApplyChart()
    {
        $app = factory(App\ApplicationDataAnalyzer::class)
        ->create([
            'JobCode'    => $this->job->RunningNumber,
            'ResumeCode' => $this->resume->RunningNumber,
        ])->fresh();

        $applyers = $app->ofPreviousDay(15)
            ->where('JobCode', $this->job->RunningNumber)
            ->with('Resume')
            ->get();

        $total = [];
        $minAge = 4;
        $maxAge = 13;

        for ($i = $minAge; $i < $maxAge; $i++) { 
            $total[$i . "male"] = 0;
            $total[$i . "female"] = 0;
        }
        
        foreach ($applyers as $applyer) {
            $age = Carbon::parse($applyer->resume->DOB)->age;
            $length = 5;
            $group = ceil($age / $length);

            if($applyer->resume->Gender == "ช") {
                $total[$group . 'male']++;
            }
            elseif($applyer->resume->Gender == "ญ") {
                $total[$group . 'female']++;
            }
        }

        $bindings = [
            [
                "type" => "column",
                "showInLegend" => true,
                "name" => "ชาย",
                "color" => "#0174DF",
                "dataPoints" => [
                    ["y" => $total['4male'], "label" => "16-20"],
                    ["y" => $total['5male'], "label" => "21-25"],
                    ["y" => $total['6male'], "label" => "26-30"],
                    ["y" => $total['7male'], "label" => "31-35"],
                    ["y" => $total['8male'], "label" => "36-40"],
                    ["y" => $total['9male'], "label" => "41-45"],
                    ["y" => $total['10male'], "label" => "46-50"],
                    ["y" => $total['11male'], "label" => "51-55"],
                    ["y" => $total['12male'], "label" => "56-60"],
                ]
            ],
            [
                "type" => "column",
                "showInLegend" => true,
                "name" => "หญิง",
                "color" => "#FF4000",
                "dataPoints" => [
                    ["y" => $total['4female'], "label" => "16-20"],
                    ["y" => $total['5female'], "label" => "21-25"],
                    ["y" => $total['6female'], "label" => "26-30"],
                    ["y" => $total['7female'], "label" => "31-35"],
                    ["y" => $total['8female'], "label" => "36-40"],
                    ["y" => $total['9female'], "label" => "41-45"],
                    ["y" => $total['10female'], "label" => "46-50"],
                    ["y" => $total['11female'], "label" => "51-55"],
                    ["y" => $total['12female'], "label" => "56-60"],
                ]
            ]
        ];

        $expect = array('data' => $bindings);
             

        $this->get('/job/' . $this->job->RunningNumber . '/genChart')
        ->seeJsonEquals($expect);

    }
}