<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ViewerLog;
use App\Job;
use App\Resume;
use App\Tambon;
use App\SubJobType;
use App\CTR;

class  RelationjobTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testhasManyviewerLog()
    {
        
        $job = factory(Job::class)->create();       
        $ViewerLog = factory(ViewerLog::class)
            ->create(['JobCode'=>$job->RunningNumber]);

        $expect = ViewerLog::where('JobCode',$job->RunningNumber)->get();

        $actual = $job->viewerLog()->get();
         
        $this->assertEquals($expect, $actual);
    } 
    
    public function testBelongToResumeRelation()
    {
        $randomnumber=  random_int(10000, 90000);

        $tambon = factory(Tambon::class)->create(['T_CODE'=> $randomnumber]);
        
        $resume = factory(Job::class)
        ->create(['TAMBONCODE'=> $tambon->T_CODE]); 
            
        $expect = Tambon::find($tambon->G_ID);

        $actual = $resume->tambon()->first();
         
        $this->assertEquals($expect, $actual);
    }

    public function testBelongToSubJobType()
    {

        $subjob = factory(SubJobType::class)->create();

        $jobtype = factory(Job::class)
            ->create(['SubJobType'=> $subjob->Code]); 
            
        $expect = SubJobType::find($subjob->Code);

        $actual = $jobtype->subJobType()->first();
         
        $this->assertEquals($expect, $actual);
    }

    public function testhasOneToCTR()
    {
    
        $JobCode = factory(Job::class)->create();

        $ctr =  factory(CTR::class)
            ->create(['JobCode'=> $JobCode->RunningNumber]); 

        $expect = CTR::find($ctr->RunningNumber);

        $actual = $JobCode->ctr()->first();
         
        $this->assertEquals($expect, $actual);
    }

}