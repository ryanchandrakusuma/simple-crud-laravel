<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
            ['name' => 'war 1', 'address' => 'jl1'],
            ['name' => 'war 2', 'address' => 'jl2'],
            ['name' => 'war 3', 'address' => 'jl3'],
            ['name' => 'war 4', 'address' => 'jl4'],
        ]);
    }
}
