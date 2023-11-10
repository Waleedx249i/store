@extends('layouts.app')

@section('content')
    <div class="p-6  space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-3xl font-semibold mb-6">Login</h1>

        <form method="POST" class="space-y-4 md:space-y-6" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="border-gray-300 rounded-lg p-4 w-full focus:outline-none focus:ring focus:border-blue-500"
                    required>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-gray-700">Remember Me</label>
            </div>

            <button type="submit"
                class="py-4 px-6 bg-blue-500 text-white text-lg rounded-lg hover:bg-blue-600">Login</button>

            @if (Route::has('password.request'))
                <a class="text-blue-500 hover:text-blue-700 ml-4" href="{{ route('password.request') }}">Forgot Your
                    Password?</a>
            @endif
        </form>
    </div>
@endsection
