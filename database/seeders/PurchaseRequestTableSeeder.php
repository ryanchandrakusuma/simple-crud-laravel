<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PurchaseRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchase_requests')->insert([
            ['vendor_id' => 1, 'status' => 'Pending'],
            ['vendor_id' => 2, 'status' => 'Rejected'],
        ]);

        DB::table('purchase_request_details')->insert([
            ['purchase_request_id' => 1, 'product_id' => 1, 'amount' => 200, 'price_total' => 2000000],
            ['purchase_request_id' => 1, 'product_id' => 2, 'amount' => 100, 'price_total' => 1000000],
            ['purchase_request_id' => 1, 'product_id' => 3, 'amount' => 300, 'price_total' => 3000000],
        ]);
    }
}
