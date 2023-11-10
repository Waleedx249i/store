@extends('layouts.app')

@section('content')
    <div class="p-8  space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-3xl font-semibold mb-6">Verify Your Email Address</h1>

        @if (session('resent'))
            <div class="mb-4 font-medium text-green-600">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="mb-4">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        <form class="inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                class="text-blue-500 hover:text-blue-700">{{ __('click here to request another') }}</button>.
        </form>
        </p>
    </div>
@endsection
