<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this?");
        }
    </script>

    <title>Update Category</title>
</head>

<body>
    @include('layouts.navigation')
    <div class="content-nav">
        <h2>Update Category</h2>
    </div>
    <br>
    <div class="button-container">
        <form action="{{ route('admin.edit', $category->id) }}">
            @method('PUT')
            @csrf
            <button type="submit">Update Category</button>
        </form>
        <form action="{{ route('admin.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirmDelete()" class="btn-delete">Delete Category</button>
        </form>
    </div>

    <form action="{{ route('admin.index') }}">
        <button class="home_btn">Home</button>
    </form>

    <div class="search-form">
        <form action="{{ route('admin.show', $category->id) }}" method="GET">
            <input type="text" name="product_name" placeholder="Search by name"
                value="{{ request('product_name') }}">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="table-container">
        <fieldset>
            <legend>Category</legend>
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
    <div class="button-container">
        <form action="{{ route('product.create') }}">
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <button>Add Products</button>
        </form>
    </div>

    <div class="table-container">
        <fieldset>
            <legend>Products</legend>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Availability</th>
                        <th>Product Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                        <tr>
                            <td>
                                {{ $product->product_name }}
                            </td>
                            <td>
                                {{ $product->product_price }}
                            </td>
                            <td>
                                {{ $product->product_availability }}
                            </td>
                            <td>
                                <img src="{{ asset('uploads/' . $product->product_image) }}" alt="Product Image"
                                    width="200">
                            </td>
                            <td>
                                <form action="{{ route('product.edit', $product->id) }}">
                                    <Button>Update Product</Button>
                                </form>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <Button onclick="return confirmDelete()" class="btn-delete">Delete Product</Button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </fieldset>
    </div>

</body>


</html>
