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

    <div class="container-nav">
        <div class="content-nav">
            <h2>My Orders</h2>
            <form action="{{ route('category.index') }}">
                <button class="button-style">Home</button>
            </form>
        </div>
    </div>
    <div class="product-listing">
        <div class="product-listing-container">
            <div class="product-list">
                @foreach ($orders as $order)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset('uploads/' . $order->product->product_image) }}" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <h3>{{ $order->product->product_name }}</h3>
                            <p>Price: {{ $order->product->product_price }}</p>
                            <p>Availability: {{ $order->product->product_availability }}</p>
                            <p>Quantity: {{ $order->quantity }}</p>
                            <p>Total Price: {{ $order->price }}</p>
                        </div>
                        <div class="product-actions">
                            <form action="{{route('order.delete', $order->id)}}">
                                <button class="button-style btn-delete">Remove From Card</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pagination">
        {{ $orders->links() }}
    </div>
</body>

</html>
