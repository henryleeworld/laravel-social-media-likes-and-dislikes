<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'       => 1,
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]
        ];

        User::insert($users);
    }
}
