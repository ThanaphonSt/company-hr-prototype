<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\ApplicationDataAnalyzer::class, function (Faker\Generator $faker) {
    return [
		'CompanyCode' 	=> 1,
		'JobCode' 		=> 1,
		'JobTitle' 		=> 'dev',
		'JobType' 		=> 'Engineer',
		'SubJobType' 	=> '1',
		'TAMBONCODE' 	=> '1',
		'ResumeCode' 	=> 1,
		'ApplyDate' 	=> $faker->dateTimeBetween(
			$startDate = '2016-07-16', 
			$endDate = '2016-08-31', 
			$timezone = date_default_timezone_get()
		),
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return[
    	'CompanyName' => $faker->company 
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
    	'CompanyCode' => 1,
    	'JobType' => 'Engineer',
    	'JobTitle' => 'dev',
    	'SubJobType' => '1',
    	'TAMBONCODE' => '1',
    	'OnlineStatus' => 1,
        'SalaryMax' => $faker->numberBetween($min = 50000 , $max = 100000),
        'SalaryMin' => $faker->numberBetween($min = 50000 , $max = 100000),
    ];
});

$factory->define(App\SubJobType::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Tambon::class, function (Faker\Generator $faker) {
    return [
    	'JA_ID' => 0,
    	'T_CODE' => $faker->numberBetween($min = 1000, $max = 9000) ,
    	'NAME_THAI' => 'โคกม่วง',
    	'PROVINCE_THAI' => 'สงขลา',
    	'AMPHOE_THAI' => 'คลองหอยโข่ง',
    ];
});

$factory->define(App\ViewerLog::class, function (Faker\Generator $faker) {
    return [
    	'JobTitleCode' => 1,
    	// 'Action' => $faker->randomElement($array = array ('apply','view','favorite')),
        'Action' => 'apply',
    	'RecType' => 'Company',
    	'Language' => 'Thai',
    	'Code' => '1',
    	'CreateDate' => $faker->dateTimeBetween(
			$startDate = '2016-07-16', 
			$endDate = '2016-08-31', 
			$timezone = date_default_timezone_get()
		),
		'JobCode' => 1,
		'JobType' => 'Engineer',
		'SubJobType' => '1',
		'CompanyCode' => '1',
    ];
});

$factory->define(App\CTR::class, function (Faker\Generator $faker) {
    return [
    	'ViewCount' => 50,
    	'ReloadCount' => 100,
    	'JobCode' => 1,
    ];
});

$factory->define(App\Resume::class, function (Faker\Generator $faker) {
    return [
    ];
});
