@extends('layouts.app')

@section('content')
    <div class="p-6  space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-3xl font-semibold mb-6">Register</h1>

        <form method="POST" class="space-y-4 md:space-y-6" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name"
                    class="border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring focus:border-blue-500"
                    required>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="border-gray-300 rounded-lg p-2 px-32 w-full focus:outline-none focus:ring focus:border-blue-500"
                    required>
            </div>

            <button type="submit"
                class="py-3 px-6 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600">Register</button>
        </form>
    </div>
@endsection
