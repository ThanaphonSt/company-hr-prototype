<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Job;
use App\Company;
use Faker\Factory;

class JobModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $job;

    protected function setup()
    {
        parent::setup();

        $faker = Factory::create();

        $jobtype = $faker->word;

        $this->job = factory(Job::class)
            ->create([
                'JobType' => $jobtype,
                'OnlineStatus' => 1,
            ])->fresh();
    }

    public function testScopeOfJobType() 
    {
        $actual = Job::ofJobType($this->job->jobtype);
        $expect = Job::where('JobType', $this->job->jobtype);
        $this->assertEquals($expect, $actual);
    }

    public function testScopeOnline()
    {
        $actual = Job::online();
        $expect = Job::where('OnlineStatus', 1);
        $this->assertEquals($expect, $actual);
    }
}