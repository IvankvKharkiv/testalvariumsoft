<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $departments = array('Sales', 'Accountant', 'Vendor');
    public function run()
    {
        foreach($this->departments as $department){
            if( is_null( Department::where('department', '=', $department)->first() ) ){
                Department::factory()->create(['department'=>$department,]);
            }
        }
        
    }
}
