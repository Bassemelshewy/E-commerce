<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Create Product</title>
</head>

<body>
    <h2>Create Product</h2>
    <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-row">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" placeholder="Enter Product Name">
        </div>
        @error('product_name')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <label for="product_price">Product Price</label>
            <input type="number" min="0" name="product_price" placeholder="Enter Product Price">
        </div>
        @error('product_price')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <label for="product_availability">Product Availability</label>
            <select name="product_availability">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>
        @error('product_availability')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <label for="product_image">Product Image</label>
            <input type="file" name="product_image">
        </div>
        @error('product_image')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <label for="category_id">Category ID</label>
            <input type="text" name="category_id" value="{{$category_id}}" readonly class="readonly">
        </div>
        @error('category_id')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit">Add</button>
    </form>
</body>

</html>
