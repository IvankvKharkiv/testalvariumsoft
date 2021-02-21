<?php

namespace Database\Seeders;

use App\Models\Employe;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $names = array(
        'Liam',
        'Noah',
        'Oliver',
        'William',
        'Elijah',
        'James',
        'Benjamin',
        'Lucas',
        'Mason',
        'Ethan',
        'Alexander',
        'Henry',
        'Jacob',
        'Michael',
        'Daniel',
        'Logan',
        'Jackson',
        'Sebastian',
        'Jack',
        'Aiden',
        'Owen',
        'Samuel',
        'Matthew',
        'Joseph',
        'Levi'
    );


    private $lnames = array(
        'Smith',
        'Johnson',
        'Williams',
        'Brown',
        'Jones',
        'Garcia',
        'Miller',
        'Davis',
        'Rodriguez',
        'Martinez',
        'Hernandez',
        'Lopez',
        'Gonzalez',
        'Wilson',
        'Anderson',
        'Thomas',
        'Taylor',
        'Moore',
        'Jackson',
        'Martin',
        'Lee',
        'Perez',
        'Thompson',
        'White'
    );
    
    public function run()
    {
        $rolescount = Role::count();
        $departmentcount = Department::count();
        $namescount = count($this->names);
        $lnamescount = count($this->lnames);

        for($i=1; $i<1000; $i++){

            Employe::factory()->create([
                'name'=>$this->names[rand(0, ($namescount-1))],
                'lname'=>$this->lnames[rand(0, ($lnamescount-1))],
                'pname'=>$this->names[rand(0, ($namescount-1))],
                'bdate'=>strval(rand(1956, 2000)). '-' . strval(rand(1, 12)) . '-' . strval(rand(1, 28)),
                'role_id'=>rand(1, $rolescount),
                'department_id'=>rand(1, $departmentcount),
                ]);

        }
        
    }
}
