<?php

use Illuminate\Database\Seeder;
use App\Company;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanyTableSeeder::class);
    }
}

class CompanyTableSeeder  extends Seeder {
    public function run() {
        Company::truncate();
        factory(Company::class,10)->create();
    }
}