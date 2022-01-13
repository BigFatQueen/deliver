<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\City;
use App\Models\Status;
use App\Models\Staff;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $array=['admin','staff','customer'];
           foreach($array as $a){
            if($a === 'staff'){
                Role::create([
                'name'=>$a,
                'guard_name'=>'staff'
             ]);
            }else{
                Role::create([
                'name'=>$a,
                'guard_name'=>'web'
             ]);
            }

           }
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);

        

         $administrator = User::create([
        'name' => 'Super Admin',
        'email' => 'admin@gmail.com',
        'phone' => '+959876543',
        'password' => Hash::make('123456789'),
      ]);

      $administrator->assignRole('admin');
      $administrator->syncPermissions($administrator->getPermissionsViaRoles());

      $staff = Staff::create([
        'name' => 'Super Staff',
        'email' => 'staff@gmail.com',
         'phone' => '+959876543',
        'password' => Hash::make('123456789'),
      ]);

      $staff->assignRole('staff');
      $staff->syncPermissions($staff->getPermissionsViaRoles());

      $this->citySeeding();
      $this->statusSeeding();

    }

     public  function  citySeeding(){
        

       
            City::create([
                'name'=>'Yangon',
                'abb'=>'YGN'
            ]);

            City::create([
                'name'=>'Mandalay',
                'abb'=>'MDY'
            ]);

            City::create([
                'name'=>'NAYPYITAW',
                'abb'=>'NPT'
            ]);
       
    }

    public  function  statusSeeding(){
        $arrray=['Not Arrived China Warehouse',
        'Warehouse',
        'Deliever',
        'Arrived Myanmar Warehouse'];

        foreach($arrray as $a){
            Status::create([
                'name'=>$a
            ]);
        }
    }
}
