<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            ['name' => 'Client 1', 'address' => 'jl1'],
            ['name' => 'Client 2', 'address' => 'jl2'],
            ['name' => 'Client 3', 'address' => 'jl3'],
            ['name' => 'Client 4', 'address' => 'jl4'],
        ]);
    }
}
