<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all();
        for($i = 0; $i < 10; $i++){
            User::create([
                "name"=> "User".$i,
                "email"=> "email".$i."@email.com",
                "password"=> bcrypt("User".$i),
            ]);
        }
    }
}
