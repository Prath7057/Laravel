<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'user_username'=>'Admin',
            'user_email'=>'admin@email.com',
            'user_password'=>'Pass@123',
        ]);
    }
}
