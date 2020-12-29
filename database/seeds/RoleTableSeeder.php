<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'production/warehouse','production/staff','production/admin',
            'procurement/staff','procurement/admin',
            'finance/staff','finance/admin'
        ];
        foreach ($roles as $role) {
        	$newRole = new Role;
        	$newRole->name=$role;
        	$newRole->save();        	
        }
    }
}
