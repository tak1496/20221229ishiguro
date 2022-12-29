<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();

        $param = [
            'user_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 2,
            'quantity' => 2,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 3,
            'quantity' => 3,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 4,
            'quantity' => 4,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 5,
            'quantity' => 5,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 6,
            'quantity' => 6,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 7,
            'quantity' => 7,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 8,
            'quantity' => 8,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 9,
            'quantity' => 9,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 10,
            'quantity' => 10,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 11,
            'quantity' => 11,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
        $param = [
            'user_id' => 1,
            'product_id' => 12,
            'quantity' => 12,
            'price' => 3000,
            'order' => 'aaaaaaaaaa',
        ];
        Order::create($param);
    }
}
