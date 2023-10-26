<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WarehouseProduct;
use DB;

class WarehouseProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses_products')->insert([
            ['product_id' => 1, 'warehouse_id' => 1, 'stock' => 100],
            ['product_id' => 2, 'warehouse_id' => 1, 'stock' => 200],
            ['product_id' => 3, 'warehouse_id' => 1, 'stock' => 300],
        ]);
    }
}
