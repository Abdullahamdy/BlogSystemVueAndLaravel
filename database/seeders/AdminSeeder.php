<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'Admin@gmail.com',
            'is_admin'=>'1',
            'password'=>bcrypt('11111111'),
            'profile_img'=>'profile_img1.jpg'
        ]);
    }
}
