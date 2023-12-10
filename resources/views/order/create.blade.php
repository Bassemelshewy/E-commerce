<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Make Order</title>
</head>

<body>
    <h2>Make Order</h2>
    <form action="{{route('order.addToOrder', $product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="form-row">
            <label for="quantity">quantity</label>
            <input type="number" id="quantityInput" name="quantity" placeholder="Enter quantity Of Product">
        </div>
        @error('quantity')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="form-row">
            <label for="product_price">Product Price</label>
            <input type="text" id="productPriceInput" name="product_price" value="{{ $product->product_price }}" readonly class="readonly">
        </div>
        @error('product_price')
            <div class="error-message">{{ $message }}</div>
        @enderror


        <div class="form-row">
            <label for="price">Total Price</label>
            <input type="text" id="totalPriceInput" name="price" readonly class="readonly">
        </div>
        @error('price')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <button type="submit">Add To Order</button>
    </form>


    <script>
        const quantityInput = document.getElementById('quantityInput');
        const productPriceInput = document.getElementById('productPriceInput');
        const totalPriceInput = document.getElementById('totalPriceInput');

        quantityInput.addEventListener('input', function() {
            const quantity = parseFloat(this.value);
            const productPrice = parseFloat(productPriceInput.value);

            if (!isNaN(quantity) && !isNaN(productPrice)) {
                const totalPrice = quantity * productPrice;
                totalPriceInput.value = totalPrice.toFixed(2);
            }else {
            totalPriceInput.value = '';
        }
        });

    </script>
</body>
</html>
