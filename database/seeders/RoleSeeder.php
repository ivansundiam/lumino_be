<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'regular_user', 'description' => 'Regular User'],
            ['name' => 'moderator'   , 'description' => 'Moderator'   ],
        ];

        foreach($roles as $role) {
            Role::create($role);
        }
    }
}
