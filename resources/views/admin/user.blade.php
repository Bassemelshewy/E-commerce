<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Users</title>
</head>

<body>
    @include('layouts.navigation')
    <div class="content-nav">
        <h2>Users</h2>
    </div>
    <br>
    <form action="{{ route('admin.index') }}">
        <button class="home_btn">Home</button>
    </form>
    <div class="search-form">
        <form action="{{ route('admin.users') }}" method="GET">
            <input type="text" name="user_name" placeholder="Search by name"
                value="{{ request('user_name') }}">
            <button type="submit">Search</button>
        </form>
    </div>

    <br>
    <div class="table-container">
        <fieldset>
            <legend>
                Users
            </legend>
            <table>
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->user_type }}
                            </td>
                            <td>
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <Button class="btn-delete">Delete User</Button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </fieldset>
    </div>
</body>

</html>
