<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'full_name' => 'Kushi Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(1111),
                'phone' => '23423323',
                'role' => 'admin',
                'status' => 'active',
            ],
            //seller
            [
                'full_name' => 'Numdin Seller',
                'username' => 'Seller',
                'email' => 'seller@gmail.com',
                'password' => Hash::make(1111),
                'phone' => '2340928423',
                'role' => 'seller',
                'status' => 'active',
            ],
            //customer
            [
                'full_name' => 'Ezekiel Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make(1111),
                'role' => 'customer',
                'status' => 'active',
            ],
        ]);
    }
}
