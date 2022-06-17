<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            'user_id' => 4,
            'total' => 60000,
            'order_date' => '2022-06-15 11:16:26',
        ];

        Order::insert($orders);
    }
}