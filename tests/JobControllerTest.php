<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Job;
use Faker\Factory;

class JobControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $job;
    protected $company;
    protected $subjob;
    protected $tambon;
    protected $ctr;
    protected $viewerLog;
    protected $applicationDataAnalyzer;

    protected function setup(){

        parent::setup();

        $faker = Factory::create();

        $jobtype1 = $faker->word;

        $jobtype2 = $faker->word;

        $t_code = $faker->numberBetween($min = 10000, $max = 90000);

        $this->company = factory(App\Company::class)->create()->fresh();

        $this->subjob = factory(App\SubJobType::class)->create()->fresh();

        $this->tambon = factory(App\Tambon::class)
                 ->create(['T_CODE' => $t_code])->fresh();

        $this->job = factory(Job::class)
            ->create([
                'CompanyCode' => $this->company->RunningNumber,
                'SubJobType' => $this->subjob->Code,
                'TAMBONCODE' => $this->tambon->T_Code,
                'JobType' => $jobtype1,
            ])->fresh();

        $this->resume = factory(App\Resume::class)
                ->create([
                    'TAMBONCODE' => $this->tambon->T_CODE,
                    'JobType1' => $this->job->JobType,
                    'JobType2' => $jobtype2,
                ])->fresh();

        $this->ctr = factory(App\CTR::class)
            ->create(['JobCode' => $this->job->RunningNumber])->fresh();

        $this->viewerLog = factory(App\ViewerLog::class)
            ->create([
                'JobCode' => $this->job->RunningNumber, 
                'CompanyCode' => $this->company->RunningNumber
            ])->fresh();

        $this->applicationDataAnalyzer = factory(App\ApplicationDataAnalyzer::class)
        ->create([
            'JobCode' => $this->job->RunningNumber,
            'ResumeCode' => $this->resume->RunningNumber,
        ])->fresh();
    }
        
    public function testShowDetailJob()
    {
        $jobs = $this->company
            ->jobs()
            ->online()
            ->get();
        
        $active = 'j' . $this->job->RunningNumber;

        $bindings = [
            ['job' => $this->job],
            ['company' => $this->company], 
            ['active' => $active],
            ['jobs' => $jobs],
        ];

        $this->get('/company/' . $this->company->RunningNumber . '/job/' . $this->job->RunningNumber)
            ->assertViewHasAll($bindings);

    }

    public function testJobsListDashboard()
    {  
        $jobs = $this->company
            ->jobs()
            ->online()
            ->paginate(20);

        $expact = ['html' =>  View::make(
            'companyHR.dashboardJobList', 
            [
                'jobs' => $jobs,
                'company' => $this->company->RunningNumber,
            ]
        )->render()];

        $actual = $this->get('/company/' . $this->company->RunningNumber . '/joblist')
            ->seeJsonEquals($expact);
    }

    public function testChartAmount()
    {   
        $total = [];
        
        $resumes = $this->applicationDataAnalyzer
            ->with('Resume')
            ->ofJobCode($this->job->RunningNumber)
            ->ofPreviousDay(15)
            ->get();

        foreach ($resumes as $resume) {
            $resumeExpectJobtype1 = $resume->Resume->JobType1;
            $resumeExpectJobtype2 = $resume->Resume->JobType2;
            $Jobtype = $this->job->JobType;

            if ($resumeExpectJobtype1 == $Jobtype || $resumeExpectJobtype2 == $Jobtype ) {
                if (isset($total[$Jobtype . '(JobType Direct)'])) {
                    $total[$Jobtype . '(JobType Direct)']++;
                } else {
                    $total[$Jobtype . '(JobType Direct)'] = 1;
                }
            } else {
                if (isset($total[$resumeExpectJobtype1])) {
                    $total[$resumeExpectJobtype1]++;
                } else {
                    $total[$resumeExpectJobtype1] = 1;
                }
            }
        }

        $expect = array('total' => $total);
             
        $this->get('/job/' . $this->job->RunningNumber . '/amountChart')
            ->seeJsonEquals($expect);
    }

    public function testSalaryJobtypeChart()
    {
        $job = $this->job;
        $k = 1000;
        $maxSalariesJob = ($job->SalaryMax) / $k;
        $minSalariesJob = ($job->SalaryMin) / $k;

        $jobs = Job::ofJobType($job->JobType);
        
        $maxSalariesJobType = ($jobs->max('SalaryMax')) / $k;
        $minSalariesJobType = ($jobs->min('SalaryMin')) / $k;
    
        $bindings =[ 
            [
                'type' => "rangeBar",
                'showInLegend' => true,
                'yValueFormatString' => "฿#0.##K",
                'indexLabel' => "{y[#index]}",
                'indexLabelFontColor' => "#000000",
                'indexLabelPlacement' => "outside" ,
                'indexLabelOrientation' => "horizontal",
                'legendText' => "เงินเดือนสูงสุดต่ำสุดของแต่ละประเภทงาน",
                'color' => "#BCF2FF " ,
                'dataPoints' => [   
                    [
                        'X' => 11 , 
                        'y' => [$minSalariesJobType, $maxSalariesJobType], 
                        'label'=> "ประเภทงาน"
                    ],
                ]
            ],
            [      
                'type' => "rangeBar",
                'showInLegend' => true,
                'yValueFormatString' => "฿#0.##K",
                'indexLabel'=> "{y[#index]}",
                'indexLabelFontColor' => "#000000",
                'indexLabelPlacement' => "outside",
                'indexLabelOrientation' => "horizontal",
                'legendText' => "เงินเดือนสูงสุดต่ำสุดของแต่ละงาน",
                'color' => "#ffa000 ",
                'dataPoints' => [  
                    [
                        'x' => 10, 
                        'y' => [$minSalariesJob, $maxSalariesJob], 
                        'label' => "งาน"
                    ],
                ]
            ]
        ];
        
        $expect = ['data' => $bindings];

        $this->get('/job/' . $job->RunningNumber . '/JobtypeChart')
            ->seeJsonEquals($expect);
    }

    public function testSalaryOfNormalDistribution()
    {
        $jobType = $this->job->JobType;

        $resume = factory(App\Resume::class)
        ->create([
            'SalaryMax' => $this->resume->SalaryMax,
            'SalaryMin' => $this->resume->SalaryMin,
        ])->fresh();

        $resumes = $resume->select('RunningNumber', 'SalaryMax', 'SalaryMin')
            ->ofJobType($jobType)
            ->get();

        $numberResume = $resumes->count();

        $salaryMean = round(($resumes->sum('SalaryMax') + $resumes->sum('SalaryMin')) / ($numberResume * 2));

        $sum = 0;

        foreach ($resumes as $resume) {
            $salaryAverage = ($resume->SalaryMax + $resume->SalaryMin) / 2;
            $sum = $sum + pow($salaryAverage - $salaryMean, 2);
        }

        $salarySD = round(sqrt($sum / $numberResume));

        $applyers = $this->app->with('Resume')
            ->ofJobCode($this->job->RunningNumber)
            ->ofPreviousDay(15)
            ->get();         
            
        $salaryApplyer = [];

        $numberOfApplyer = [];

        foreach ($applyers as $apply) {
            $salaryApply = round(($apply->Resume->SalaryMax) + ($apply->Resume->SalaryMin) / 2);
            $salaryApplyer[] = $salaryApply;

            if (isset($numberOfApplyer[$salaryApply])) {
                $numberOfApplyer[$salaryApply]++;
            } else {
                $numberOfApplyer[$salaryApply] = 1;
            }
         }

        $salaryApplyer = array_unique($salaryApplyer);
        sort($salaryApplyer);
        $lastIndex = count($salaryApplyer) - 1;
        $expect = ['salaryMean' => $salaryMean,
            'salarySD' => $salarySD,
            'salaryApplyer' => $salaryApplyer,
            'numberOfApplyer' => $numberOfApplyer,
            'lastIndex' => $lastIndex
            ];

        $this->get('/job/' . $this->job->RunningNumber . '/normalDistribution')
            ->seeJsonEquals($expect);
    }
}