<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User'],
            // Add more roles as needed
        ];

        // Insert the data into the "roles" table
        Role::insert($roles);
    }
}
