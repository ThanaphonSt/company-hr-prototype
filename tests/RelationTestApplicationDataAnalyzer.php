 <?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ApplicationDataAnalyzer;
use App\ViewerLog;
use App\Resume;


class  RelationTestApplicationDataAnalyzer extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testBelongToResumeRelation()
    {  

        $resume = factory(Resume::class)->create();

        $applicationDataAnalyzer = factory(ApplicationDataAnalyzer::class)
            ->create(['ResumeCode'=> $resume->RunningNumber]);       
      
        $expect = Resume::find($resume->RunningNumber);
        
        $actual = $applicationDataAnalyzer->resume()->first();
        
        $this->assertEquals($expect, $actual);

    }
}