<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ApplicationDataAnalyzer;
use App\ViewerLog;
use Faker\Factory;
use Carbon\Carbon;

class  ApplicationDataAnalyzerModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $applicationDataAnalyzer;

    protected function setup()
    {
        parent::setup();

        $faker = Factory::create();
        $createDate =  $faker->dateTimeBetween(
            $startDate = '2016-07-16', 
            $endDate = '2016-08-31', 
            $timezone = date_default_timezone_get()
        );
        $jobType = str_random(5);
        $resumeCode = $faker->numberBetween($min = 10000, $max = 90000);
        $jobCode = $faker->numberBetween($min = 10000, $max = 90000);

        $this->applicationDataAnalyzer = factory(ApplicationDataAnalyzer::class)
            ->create([
                'ApplyDate'=> $createDate,
                'JobType' => $jobType,
                'ResumeCode'=> $resumeCode,
                'JobCode'=> $jobCode
            ])
            ->fresh();
    }

 	public function testScopeOfPreviousDay()
    {
        $nowDate = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok');
        $DatePrevious = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok')
        ->subDays(15);

        $actual = ApplicationDataAnalyzer::ofPreviousDay(15);
        $expect = ApplicationDataAnalyzer::whereBetween('ApplyDate', [$DatePrevious, $nowDate]);
        $this->assertEquals($expect, $actual);
    }

    public function testScopeOfJobType() 
    {
        $jobType = $this->applicationDataAnalyzer->jobtype;

        $actual = ApplicationDataAnalyzer::ofJobType($jobType);
        $expect = ApplicationDataAnalyzer::where('JobType', $jobType);
        $this->assertEquals($expect, $actual);
    }

    public function testScopeOfResumeCode()
    {
        $resumeCode = $this->applicationDataAnalyzer->resume;

     	$actual = ApplicationDataAnalyzer::ofResumeCode($resumeCode);
        $expect = ApplicationDataAnalyzer::where('ResumeCode', $resumeCode);
        $this->assertEquals($expect, $actual);
    }

    public function testScopeOfJobCode()
    {   
        $jobCode = $this->applicationDataAnalyzer->jobCode;

     	$actual = ApplicationDataAnalyzer::ofJobCode($jobCode);
        $expect = ApplicationDataAnalyzer::where('JobCode', $jobCode);
        $this->assertEquals($expect, $actual);
    }
     
}
