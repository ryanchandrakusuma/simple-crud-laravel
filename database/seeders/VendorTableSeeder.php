<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([
            ['name' => 'Ven 1', 'address' => 'jl1'],
            ['name' => 'Ven 2', 'address' => 'jl2'],
            ['name' => 'Ven 3', 'address' => 'jl3'],
            ['name' => 'Ven 4', 'address' => 'jl4'],
        ]);
    }
}
