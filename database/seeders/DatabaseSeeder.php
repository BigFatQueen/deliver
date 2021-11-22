<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\City;
use App\Models\Status;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $array=['admin','staff','customer'];
           foreach($array as $a){
             Role::create([
                'name'=>$a
             ]);
           }

         $administrator = User::create([
        'name' => 'Super Admin',
        'email' => 'admin@gmail.com',
        'phone' => '+959876543',
        'password' => Hash::make('123456789'),
      ]);

      $administrator->assignRole('admin');

      $staff = User::create([
        'name' => 'Super Staff',
        'email' => 'staff@gmail.com',
         'phone' => '+959876543',
        'password' => Hash::make('123456789'),
      ]);

      $staff->assignRole('staff');

      $this->citySeeding();
      $this->statusSeeding();

    }

     public  function  citySeeding(){
        $arrray=['Yangon','Mandalay','Sagaing'];

        foreach($arrray as $a){
            City::create([
                'name'=>$a
            ]);
        }
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
