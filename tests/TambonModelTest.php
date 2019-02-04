<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Tambon;

class TambonModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testscopeOfProvince()
    {
        $id = random_int(1, 10); 

        $tambon = factory(Tambon::class)->create(['T_CODE' => $id])->fresh();

        $actual = Tambon::ofProvince($id);

        $expect = Tambon::where('P_CODE',$id);
        
        $this->assertEquals($expect, $actual);
    }
}