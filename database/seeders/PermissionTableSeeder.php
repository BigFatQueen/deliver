<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'order-list',
           'order-create',
           'order-edit',
           'order-delete',
           'user-ban',
           'order-status'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }

        $role=Role::find(1);
        $role2=Role::find(2);

        
        
         $permissions = Permission::pluck('id','id')->all();
        
   
       $role->syncPermissions($permissions);
       $role2->givePermissionTo('order-status');
      
    }
}
