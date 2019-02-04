<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ViewerLog;
use Carbon\Carbon;
use Faker\Factory;

class ViewerLogModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testScopeOfAction()
    {
        $faker = Factory::create();

        $action = $faker->randomElement($array = array ('apply','view','favorite'));

        $viewerLog = factory(ViewerLog::class)->create(['Action' => $action])->fresh();

        $actual = ViewerLog::ofAction($action);

        $expect = ViewerLog::where('Action', $action);
        
        $this->assertEquals($expect, $actual);
    }

    public function testScopeOfPreviousDay()
    {

        $faker = Factory::create();
        $createDate =  $faker->dateTimeBetween(
        $startDate = '2016-07-16', 
        $endDate = '2016-08-31', 
        $timezone = date_default_timezone_get());

        $viewerLog = factory(ViewerLog::class)
        ->create(['CreateDate'=> $createDate])
        ->fresh();

        $nowDate = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok');
        $DatePrevious = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok')
        ->subDays(15);

        $actual = ViewerLog::ofPreviousDay(15);
        $expect = ViewerLog::whereBetween('CreateDate', [$DatePrevious, $nowDate]);

        $this->assertEquals($expect, $actual);

    }

    public function testScopeOfJobCode()
    {
        $jobCode = random_int(1, 10);

        $Code = factory(ViewerLog::class)->create(['JobCode'=> $jobCode])->fresh();

        $actual = ViewerLog::ofJobCode($jobCode);

        $expect = ViewerLog::where('JobCode', $jobCode);
        
        $this->assertEquals($expect, $actual);
    }
}