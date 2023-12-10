<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>

        <div class="search-form">
            <form action="{{ route('category.index') }}" method="GET">
                <input type="text" name="category_name" placeholder="Search by name"
                    value="{{ request('category_name') }}" class="input-style">
                <button class="button-style">Search</button>
            </form>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                            <form action="{{ route('category.show', $category->id) }}">
                                                <button class="button-style">View Products</button>
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
            </div>
        </div>
    </div>

</x-app-layout>
