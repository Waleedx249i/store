@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Product Form</h1>

        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name"
                    class="border-gray-300 rounded-lg p-4 w-full focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ isset($product) ? $product->name : '' }}" required>
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                <input type="number" name="price" id="price"
                    class="border-gray-300 rounded-lg p-4 w-full focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ isset($product) ? $product->price : '' }}" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description"
                    class="border-gray-300 rounded-lg p-4 w-full h-32 resize-none focus:outline-none focus:ring focus:border-blue-500"
                    required>{{ isset($product) ? $product->description : '' }}</textarea>
            </div>

            <div class="mb-6">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                <select name="category_id" id="category"
                    class="border-gray-300 rounded-lg p-4 w-full focus:outline-none focus:ring focus:border-blue-500"
                    required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                <div class="flex items-center">
                    <div id="image-preview" class="w-16 h-16 mr-4 overflow-hidden rounded-lg border-2 border-gray-300">
                        @if (isset($product) && $product->image)
                            <img id="selected-image" src="{{ $product->image }}" alt="{{ $product->name }}"
                                class="object-cover object-center w-full h-full">
                        @else
                            <svg class="w-full h-full text-gray-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        @endif
                    </div>
                    <label for="image"
                        class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Choose an
                        Image</label>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                </div>
            </div>

            <button type="submit" class="py-4 px-6 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600">
                {{ isset($product) ? 'Update' : 'Create' }}</button>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('selected-image');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });
    </script>
@endsection
