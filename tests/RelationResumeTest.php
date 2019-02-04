<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ApplicationDataAnalyzer;
use App\ViewerLog;
use App\Resume;
use App\Tambon;


class  RelationResumeTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testBelongToResumeRelation()
    {
        $randomnumber=  random_int(10000, 90000);

        $tambon = factory(Tambon::class)->create(['T_CODE'=> $randomnumber]);
        
        $resume = factory(Resume::class)
            ->create(['TAMBONCODE'=> $tambon->T_CODE]); 
            
        $expect = Tambon::find($tambon->G_ID);

        $actual = $resume->tambon()->first();
         
        $this->assertEquals($expect, $actual);
    }

}