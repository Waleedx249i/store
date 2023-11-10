@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Categories</h1>
        <div>
            <h2 class="text-2xl font-semibold mb-4">Create Category</h2>
            <form class="mb-20" action="{{ route('categories.store') }}" method="POST">
                @csrf


                <div class="mb-2">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" id="name"
                        class="border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring focus:border-blue-500"
                        value='' required>
                </div>

                <button type="submit" class="py-2 px-3 mb-5 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600">
                    Create Category
                </button>
            </form>
        </div>
        <!-- Category Index -->
        <div class="mb-8">

            <ul class="">

                <tbody>
                    @foreach ($categories as $category)
                        <li class="flex flex-row  content-around">
                            <p class="py-3  px-6 border-b border-gray-300">{{ $category->name }}</p>
                            <div class="py-3 flex-auto px-6 border-b border-gray-300">

                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="text-blue-500  hover:text-blue-700">Edit</a>



                                <form class="text-red-600 hover:text-red-900"
                                    action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>

                            </div>
                        </li>
                    @endforeach

            </ul>
        </div>



    </div>
@endsection
