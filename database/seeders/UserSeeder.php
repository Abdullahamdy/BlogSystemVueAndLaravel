<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Abdullah Hamdy',
            'email'=>'abdullah@gmail.com',
            'password'=>bcrypt('11111111'),
            'profile_img'=>'profile_img1.jpg'
        ]);
    }
}
