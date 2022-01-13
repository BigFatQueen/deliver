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
             Permission::create(['name' => $permission,'guard_name'=>'web']);
        }

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission,'guard_name'=>'staff']);
        }

        $role=Role::where('name','customer')->first();
        $role2=Role::where('name','admin')->first();
        $role3=Role::where('name','staff')->first();
        
        
         $allpermissions = Permission::where('guard_name','web')->pluck('id','id')->all();
           $staffpermissions = Permission::where('guard_name','staff')->pluck('id','id')->all();
        
        $role->givePermissionTo(['order-list',
           'order-create',
           'order-edit',
           'order-delete']);
       $role2->syncPermissions($allpermissions);
       $role3->syncPermissions($staffpermissions);
       
      
    }
}
