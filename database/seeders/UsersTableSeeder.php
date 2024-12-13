<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Usman',
                'email' => 'usman@gmail.com',
                'username' => 'usman',
                'password' => Hash::make('123456'),
                'role' => 'company',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anas',
                'email' => 'anas@gmail.com',
                'username' => 'anas',
                'password' => Hash::make('123456'),
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
