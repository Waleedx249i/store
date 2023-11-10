@extends('layouts.app')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <div></div>
        <h1 class="mb-4 text-2xl font-semibold">Products</h1>

        <a href="{{ route('products.create') }}" class="text-blue-500 underline">Add Product</a>


        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="p-4 bg-white rounded-lg shadow">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mb-4">
                    <h2 class="mb-2 text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">Price: ${{ $product->price }}</p>
                    <p class="text-gray-600">description: {{ $product->description }}</p>
                </div>
            @endforeach


        </div>
    </div>
@endsection
