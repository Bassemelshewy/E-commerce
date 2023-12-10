<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Admin Home</title>
</head>

<body>
    @include('layouts.navigation')
    <div class="content-nav">
        <h2>Admin Home</h2>
    </div>
    <br>
    <div class="search-form">
        <form action="{{ route('admin.index') }}" method="GET">
            <input type="text" name="category_name" placeholder="Search by name"
                value="{{ request('category_name') }}">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="button-container">
        <form action="{{ route('admin.create') }}">
            <button>Add Category</button>
        </form>
        <form action="{{ route('registerAdmin') }}">
            <button>Add Admin</button>
        </form>

        <form action="{{ route('admin.users') }}">
            <button>Users</button>
        </form>
    </div>
    <br>
    <div class="table-container">
        <fieldset>
            <legend>
                Categories
            </legend>
            <table>
                <thead>
                    <tr>
                        <th>Category Id</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->category_name }}
                            </td>
                            <td>
                                <form action="{{ route('admin.show', $category->id) }}">
                                    <Button>Update Category</Button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $categories->links() }}
            </div>
        </fieldset>
    </div>
</body>

</html>
