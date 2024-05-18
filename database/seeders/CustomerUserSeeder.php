<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("tbl_customer_users")->insert([
            [
                "username" => "nguyendat72",
                "password" => Hash::make("123456"),
                "name" => "dat",
                "email" => "nnguyendat72@gmail.com",
                "phone" => "032481631",
                "sex" => "Nam",
                "DOB" => "2004-02-07",
                "img" => "havert.jpg",
                "address" => "Hoang Huu Nam / Thu Duc"
            ],
            [
                "username" => "minhHiep33",
                "password" => Hash::make("123456"),
                "name" => "hiep",
                "email" => "minhhiep325@gmail.com",
                "phone" => "0324421",
                "sex" => "Nam",
                "DOB" => "2004-12-02",
                "img" => "havert.jpg",
                "address" => "Le Van Viet / Thu Duc"
            ]
        ]);
    }
}
