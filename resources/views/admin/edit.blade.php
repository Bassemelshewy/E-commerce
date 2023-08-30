<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Update Category</title>
</head>

<body>
    <h2>Update Category</h2>
    <form action="{{ route('admin.update', $category->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-row">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" value="{{ $category->category_name }}">
        </div>
        @error('category_name')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit">Update</button>
    </form>
</body>

</html>
