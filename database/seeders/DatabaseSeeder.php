<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $product1 = Product::create([
            'name' => 'Product 1',
            'price' => 10,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);

        $product2 = Product::create([
            'name' => 'Product 2',
            'price' => 20,
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
        ]);

        $order1 = $user->orders()->create([
            'quantity' => 2,
        ]);
        $order1->orderable()->associate($product1);
        $order1->save();

        $order2 = $user->orders()->create([
            'quantity' => 3,
        ]);
        $order2->orderable()->associate($product2);
        $order2->save();

    }
}
