<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'user_id' => 1,
                'company_name' => 'Global Dezigns',
                'website' => 'https://www.globaldezigns.com/',
                'phone' => '123456789',
                'address' => 'Suite: 48, Habib Chamber Karachi',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
