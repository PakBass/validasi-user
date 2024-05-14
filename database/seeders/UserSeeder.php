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
        $admin = User::create([
            'name'      => 'Admin Role',
            'email'     => 'admin@test.com',
            'password'  => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        $operator = User::create([
            'name'      => 'Operator Role',
            'email'     => 'opt@test.com',
            'password'  => bcrypt('password')
        ]);

        $operator->assignRole('operator');

        $user = User::create([
            'name'      => 'User Role',
            'email'     => 'user@test.com',
            'password'  => bcrypt('password')
        ]);

        $user->assignRole('user');
    }
}
