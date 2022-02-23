<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> "Admin",
            'email'=>'Admin@gmail.com',
            'password'=> Hash::make(12345678),
        ]);
        User::create([
            'name'=> "User",
            'email'=>'User@gmail.com',
            'password'=> Hash::make(12345678),
        ]);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
