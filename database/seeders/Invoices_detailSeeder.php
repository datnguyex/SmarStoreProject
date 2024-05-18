<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Invoices_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("tbl_invoices-detail")->insert([
                [
                    'invoice_id' => 1,
                    'product_id' => 1,
                    'invoice_date' => '2024-04-20',
                    'price' => 50.00,
                    'total' => 50.00,
                ],
        ]);
    }
}