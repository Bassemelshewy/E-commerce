<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Admin Home</title>
</head>

<body>
    <h2>Add Category</h2>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-row">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" placeholder="Enter Category Name">
        </div>
        @error('category_name')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit">Add</button>
    </form>
</body>

</html>
