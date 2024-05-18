<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Hash;

class Cart_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("cart_detail")->insert([
            [
                'cart_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
            ],
            [
                'cart_id' => 1,
                'product_id' => 8,
                'quantity' => 2,
            ],
            [
                'cart_id' => 2,
                'product_id' => 1,
                'quantity' => 1,
            ],
            [
                'cart_id' => 2,
                'product_id' => 6,
                'quantity' => 1,
            ],
            [
                'cart_id' => 3,
                'product_id' => 1,
                'quantity' => 1,
            ],
            [
                'cart_id' => 3,
                'product_id' => 1,
                'quantity' => 1,
            ],
            [
                'cart_id' => 3,
                'product_id' => 7,
                'quantity' => 1,
            ]
    ]);
    }
}
