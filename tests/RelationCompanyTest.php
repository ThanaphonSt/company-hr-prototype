<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ViewerLog;
use App\Company;
use App\Job;

class  RelationCompanyTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $company;
    protected $viewerLog;
    protected $job;

    protected function setup()
    {
        parent::setup();

        $this->company = factory(Company::class)->create(); 

        $this->viewerLog = factory(ViewerLog::class)
            ->create(['CompanyCode' => $this->company->RunningNumber]);

        $this->job = factory(Job::class)
            ->create(['CompanyCode' => $this->company->RunningNumber]);
    }

    public function testhasManyviewerLog()
    {
        $expect = ViewerLog::where('CompanyCode', $this->company->RunningNumber)->get();

        $actual = $this->company->viewerLog()->get();
         
        $this->assertEquals($expect, $actual);
    } 

    public function testhasManyjobs()
    {
       $expect = Job::where('CompanyCode', $this->company->RunningNumber)->get();

       $actual = $this->company->jobs()->get();
         
       $this->assertEquals($expect, $actual);
    } 
}