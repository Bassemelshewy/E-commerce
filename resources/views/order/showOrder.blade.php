<?php
use app\Http\Controllers\OrderController;
$count = OrderController::getOrderNumber();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <title>My Orders</title>
</head>

<body>
    @include('layouts.navigation')

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold">My Orders</h2>
            <form action="{{ route('category.index') }}">
                <button class="home_btn">Home</button>
            </form>
        </div>
    </header>
    <div class="container-nav">
        @foreach ($orders as $order)
        <div class="content-nav">
            <h2>Order Number: {{ $order->order_number }}</h2>
            <ul class="list">
                    <li>Total amount: {{ $order->total_amount }}</li>
                    <li>shipping address: {{ $order->shipping_address }}</li>
                    <li>order status: {{ $order->status }}</li>
                    <li>order date: {{ $order->order_date }}</li>
                </ul>
        </div>
        <div class="product-listing">
            <div class="product-listing-container">
                <div class="product-list">
                    @foreach ($order->products as $product)
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{ asset('uploads/' . $product->product_image) }}" alt="Product Image">
                            </div>
                            <div class="product-details">
                                <h3>{{ $product->product_name }}</h3>
                                <p>Price: {{ $product->product_price }}</p>
                                <p>Quantity: {{ $product->pivot->quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>


</body>

</html>
