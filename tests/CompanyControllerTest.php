<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $company;
    protected $subjob;
    protected $job;
    protected $tambon;
    protected $viewerLog;
    protected $ctr;
    protected $company_name;

    protected function setup()
    {
        parent::setup();

        $this->company = factory(App\Company::class)->create()->fresh();

        $this->subjob = factory(App\SubJobType::class)->create()->fresh();

        $this->tambon = factory(App\Tambon::class)->create(['T_CODE' => '2'])->fresh();

        $this->createJob();

        $this->viewerLog = factory(App\ViewerLog::class)
            ->create([
                'JobCode' => $this->job->RunningNumber, 
                'CompanyCode' => $this->company->RunningNumber,
            ])
            ->fresh();

        $this->ctr = factory(App\CTR::class)
            ->create(['JobCode'  => $this->job->RunningNumber])->fresh();
    }

    protected function createJob()
    {
        $this->subjob = factory(App\SubJobType::class)->create()->fresh();

        $this->job = factory(App\Job::class)
            ->create([
                'CompanyCode' => $this->company->RunningNumber,
                'SubJobType' => $this->subjob->Code,
                'TAMBONCODE' => $this->tambon->T_CODE,
            ])
            ->fresh(); 
    }

    public function testSearchCompanyName()
    {
        $company_name = $this->company
            ->ofCompanyName($this->company->CompanyName)
            ->paginate(20);

        $expect = ['CompanyNames' => $company_name->toArray()];

        $this->post('/companyhr', ['search' => $this->company->CompanyName])
            ->seeJsonEquals($expect);
    }   

    public function testShowDetailDashboard()
    {
        $jobs = $this->company
            ->jobs()
            ->online()
            ->get();

        $countView = $this->company
            ->viewerLog()
            ->ofAction('view')
            ->ofPreviousDay(15)
            ->count();

        $countApply = $this->company
            ->viewerLog()
            ->ofAction('apply')
            ->ofPreviousDay(15)
            ->count();

        $bindings = [
            ['countView' => $countView],
            ['countApply' => $countApply],
            ['company' => $this->company], 
            ['jobs' => $jobs],
        ];

        $this->get('/company/' . $this->company->RunningNumber)
            ->assertViewHasAll($bindings);
     }
}
