<?php

namespace Database\Seeders;

use App\Models\Employe;
use App\Models\Salary;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employes = Employe::all();
        $employes->each(function($employe){
            $hourly_wage = rand(0,1) == 1;
            Salary::factory()->create([
                'employe_id'=>$employe->id,
                'hours'=> $hourly_wage ? rand(1, 160) : 0,
                'hourly_wage' => $hourly_wage, 
                ]);
        });


        //
    }
}
