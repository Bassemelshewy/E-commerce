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
    <title>My Cart</title>
</head>

<body>
    @include('layouts.navigation')

    {{-- <div class="container-nav">
        <div class="content-nav">
            <h2>My Cart</h2>
            <form action="{{ route('category.index') }}">
                <button class="btn-primary">Home</button>
            </form>
        </div>
    </div> --}}
    {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900"> --}}
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold">My Cart</h2>
                <form action="{{ route('category.index') }}">
                    <button class="home_btn">Home</button>
                </form>
            </div>
        </header>
    {{-- </div> --}}
    <div class="container-nav">
        <div class="content-nav">
            <form action="{{route('order.store')}}" method="POST">
                @csrf
                @method('POST')

                <div class="form-columns">
                    <div class="form-column">

                        <label for="order-number">Order Number</label>
                        <input type="text" name="order_number" class="readonly" value="{{ $count + 1 }}" readonly>

                        <label for="total-amount">Total Amount</label>
                        <input type="text" name="total_amount" class="readonly" value="{{ $total_amount }}" readonly>

                    </div>
                    <div class="form-column">

                        <label for="shipping-address">Shipping Address</label>
                        <textarea name="shipping_address" placeholder="Enter Your Address" style="resize: none;" ></textarea>

                        <label for="order-date">Order Date</label>
                        <input type="date" name="order_date">

                        {{-- <label for="status" >Status</label>
                        <select id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select> --}}

                        </div>
                    </div>
                    @error('shipping_address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    @error('order_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                <button type="submit" class="btn-primary">Make Order</button>
            </form>
        </div>
    </div>

    <div class="product-listing">
        <div class="product-listing-container">
            <div class="product-list">
                @foreach ($productDetails as $item)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset('uploads/' . $item['product']->product_image) }}" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <h3>{{ $item['product']->product_name }}</h3>
                            <p>Price: {{ $item['product']->product_price }}</p>
                            <p>Availability: {{ $item['product']->product_availability }}</p>
                            <p>Quantity: {{ $item['quantity'] }}</p>
                            <p>Total Price: {{ $item['quantity'] * $item['product']->product_price }}</p>

                        </div>
                        <div class="product-actions">
                            <form action="{{ route('order.removeFromOrder', $item['product']->id) }}">
                                <div class="form-row">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="quantity">
                                </div>
                                <button class="button-style btn-delete">Remove From Order</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
