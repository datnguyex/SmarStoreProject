<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Hash;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("tbl_invoices")->insert([
            [
                'user_Id' => 1,
                'Order_Describe' => 'Mô tả đơn hàng cho đối tượng đầu tiên',
                'TotalAmount' => 100.00,
                'PaymentMethod' => 'Credit Card',
                'PaymentStatus' => 'Completed',
            ],
            [
                'user_Id' => 2,
                'Order_Describe' => 'Mô tả đơn hàng cho đối tượng thứ hai',
                'TotalAmount' => 150.00,
                'PaymentMethod' => 'PayPal',
                'PaymentStatus' => 'Completed',
            ],
            [
                'user_Id' => 3,
                'Order_Describe' => 'Mô tả đơn hàng cho đối tượng thứ ba',
                'TotalAmount' => 200.00,
                'PaymentMethod' => 'Cash',
                'PaymentStatus' => 'Failed',
            ]
    ]);
    }
}
