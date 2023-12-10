<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <title>Products</title>
</head>

<body>
    @include('layouts.navigation')

    {{-- <div class="container-nav">
        <div class="content-nav">
            <h2>Products</h2>
            <div class="search-form">
                <form action="{{ route('category.show', $category->id) }}" method="GET">
                    <input type="text" name="product_name" placeholder="Search by name"
                        value="{{ request('product_name') }}">
                    <button type="submit" class="button-style">Search</button>
                </form>
            </div>
        </div>
    </div> --}}
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold">Products</h2>
            {{-- <div class="search-form">
                <form action="{{ route('category.show', $category->id) }}" method="GET">
                    <input type="text" name="product_name" placeholder="Search by name" value="{{ request('product_name') }}" class="input-style">
                    <button class="button-style">Search</button>
                </form>
            </div> --}}
            <div class="search-form">
                <form action="{{ route('category.index') }}" method="GET" class="flex">
                    <input type="text" class="input-style"  name="category_name" placeholder="Search by name"
                        value="{{ request('category_name') }}">
                    <button class="button-style">Search</button>
                </form>
            </div>
        </div>
    </header>
    <form action="{{ route('category.index') }}">
        <button class="home_btn">Home</button>
    </form>


    <div class="table-content">
        <div class="table-container">
            <fieldset>
                <legend>
                    Category
                </legend>
                <table>
                    <thead>
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->category_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
    <div class="product-listing">
        <div class="product-listing-container">

            <div class="product-list">
                @foreach ($products as $product)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset('uploads/' . $product->product_image) }}" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <h3>{{ $product->product_name }}</h3>
                            <p>Price: {{ $product->product_price }}</p>
                            <p>Availability: {{ $product->product_availability }}</p>
                        </div>
                        @if ($product->product_availability == 'Unavailable')
                            <div class="product-actions">
                                <button class="button-style disabled-button">Add To Cart</button>
                            </div>
                        @else
                            <div class="product-actions">
                                <form action="{{ route('order.create', $product->id) }}">
                                    <button class="button-style">Add To Card</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
            {{-- <div class="product-listing">
                <div class="product-listing-container">
                    <div class="product-list">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="products-container">
                                @foreach ($products as $product)
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img src="{{ asset('uploads/' . $product->product_image) }}" alt="Product Image">
                                        </div>
                                        <div class="product-details">
                                            <h3>{{ $product->product_name }}</h3>
                                            <p>Price: {{ $product->product_price }}</p>
                                            <p>Availability: {{ $product->product_availability }}</p>
                                        </div>
                                        @if ($product->product_availability != 'Unavailable')
                                            <div class="product-actions">
                                                <label for="quantity_{{ $product->id }}">Quantity:</label>
                                                <input type="number" id="quantity_{{ $product->id }}" name="products[{{ $product->id }}][quantity]" min="1">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="button-style">Add to Cart</button>
                        </form>
                    </div>
                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

</body>

</html>
