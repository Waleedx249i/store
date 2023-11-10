@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h1>

        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
            method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name"
                    class="border-gray-300 rounded-lg p-4 w-full focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ isset($category) ? $category->name : '' }}" required>
            </div>

            <button type="submit" class="py-4 px-6 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600">
                {{ isset($category) ? 'Update Category' : 'Create Category' }}
            </button>
        </form>
    </div>
@endsection
