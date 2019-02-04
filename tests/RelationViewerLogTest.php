 <?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ViewerLog;
use App\Resume;


class  RelationViewerLogTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testBelongToResumesRelation()
    {  

        $resume = factory(Resume::class)->create();

        $viewerLog = factory(ViewerLog::class)
            ->create(['Code'=> $resume->RunningNumber]);       
      
        $expect = Resume::find($resume->RunningNumber);
        
        $actual = $viewerLog->resumes()->first();
        
        $this->assertEquals($expect, $actual);

    }
}