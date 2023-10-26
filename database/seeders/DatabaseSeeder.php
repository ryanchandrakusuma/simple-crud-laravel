<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerTableSeeder;
use Database\Seeders\VendorTableSeeder;
use Database\Seeders\WarehouseTableSeeder;
use Database\Seeders\ProductTableSeeder;
use Database\Seeders\WarehouseProductTableSeeder;
use Database\Seeders\PurchaseRequestTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CustomerTableSeeder::class,
            WarehouseTableSeeder::class,
            ProductTableSeeder::class,
            VendorTableSeeder::class,
            PurchaseRequestTableSeeder::class,
            WarehouseProductTableSeeder::class,
        ]);
    }
}
