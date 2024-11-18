<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =new User();

        $user->name = 'Usuario Admin';
        $user->email = 'adminUtn@gmail.com';
        $user->password = '12345678';
        $user->role = 'admin';

        $user->save();

    }
}
