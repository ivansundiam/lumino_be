<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $users = [
            [
                "first_name" => "user",
                "last_name" => "user",
                "contact" => "+63912312312",
                "role_id" => Role::REGULAR_USER,
                "email" => "user@email.com",
                "password" => "password",
            ],
            [
                "first_name" => "moderator",
                "last_name" => "moderator",
                "contact" => "+63912312312",
                "role_id" => Role::MODERATOR,
                "email" => "moderator@email.com",
                "password" => "password",
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
