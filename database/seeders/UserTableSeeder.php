<?php

namespace Database\Seeders;

use Str;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminUser= User::create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "admin@livedemoproject.com",
            'password' => "Acuity##22",
            'user_id' => Str::random(6),
            'active'=>true
        ]);
        $superAdminUser->assignRole('SUPER-ADMIN');
        /*User::factory(5)->create()->each(function ($user) {
            $user->assignRole('CLIENT');
        });*/
    }
}
