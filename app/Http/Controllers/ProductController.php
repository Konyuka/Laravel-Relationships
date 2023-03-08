<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;


class ProductController extends Controller
{
    //
    public function index()
    {
        // one to one
        $order = Order::find(1);
        $product = $order->orderable;
        $oneToOne = $product;

        // one to many
        $user = User::find(1);
        $orders = $user->orders;
        $oneToMany = [];
        foreach ($orders as $order) {
            array_push($oneToMany, $order);
        }
        

        // one of many
        $product = Product::find(2);
        $orders = $product->orders;
        $oneOfMany = [];
        foreach ($orders as $order) {
            array_push($oneOfMany, $order);
        }


        // many to many
        $order = Order::find(1);
        $user = $order->user;
        $products = $user->products;
        if(!is_null($products)){
            $manyToMany = [];
            foreach ($products as $product) {
                array_push($manyToMany, $product);
            }
        }else{
            $manyToMany = $products;
        }

        // custom morph
        // $user = User::find(1);
        // $product = Product::find(1);
        // $coupon = Coupon::create([
        //     'code' => '10OFF',
        //     'discount' => 10.00,
        // ]);
        // $order = $user->orders()->create([
        //     'orderable_id' => $product->id,
        //     'orderable_type' => Product::class,
        //     'quantity' => 2,
        //     'couponable_id' => $coupon->id,
        //     'couponable_type' => Coupon::class,
        // ]);


        return Inertia::render('Welcome', [
            'oneToOne' => $oneToOne,
            'oneToMany' => $oneToMany,
            'oneOfMany' => $oneOfMany,
            'manyToMany' => $manyToMany,
            'products' => Product::all(),
            'users' => User::all(),
            'orders' => Order::all()
        ]);
    }
}
