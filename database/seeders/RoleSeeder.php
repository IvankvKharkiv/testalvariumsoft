<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $roles = array('Manager', 'Mainmanager', 'Worker');
    public function run()
    {
        foreach($this->roles as $role){
            if( is_null( Role::where('role', '=', $role)->first() ) ){
                Role::factory()->create(['role'=>$role,]);
            }
        }
        
    }
}
