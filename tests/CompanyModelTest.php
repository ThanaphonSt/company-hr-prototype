<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Company;
use Faker\Factory;

class CompanyModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testScopeOfCompanyName()
    {
        $faker = Factory::create();
        $word = $faker->word;

        $company = factory(Company::class)
            ->create(['CompanyName' => $word ])->fresh();

        $actual = Company::ofCompanyName($word);

        $expect = Company::where('CompanyName', 'like', '%' . $word . '%');
        
        $this->assertEquals($expect, $actual);
    }


}