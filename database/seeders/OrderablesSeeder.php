<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Seed orderables table with products
        $orders = Order::all();
        $products = Product::all();
        
        foreach ($orders as $order) {
            // Attach random products to each order
            $order->products()->attach($products->random(), ['quantity' => rand(1, 5)]);
        }
    }
}
