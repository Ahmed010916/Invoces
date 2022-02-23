<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name'=>'Admin','display_name' =>"Admin",'description'=>"The Admin All Web Site"],
            ['name'=>'User' ,'display_name' =>"User",'description'=>"The User"],
        ];

        foreach ($roles as $role => $value) {

            $role = Role::create([
                'name'=>$value['name'],
                'display_name' =>$value['display_name'],
                'description'=> $value['description'],
            ]);
        }

        User::find(1)->attachRole('Admin');
        User::find(2)->attachRole('USer');
    }
}
