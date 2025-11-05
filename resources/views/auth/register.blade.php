@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('title', 'Create a New Account')

@section('content')
<section class="auth-container">
<h1 class="text-3xl font-bold mb-6 text-center">Join Nolan's Bakery!</h1>
<div class="form-card">
<form method="POST" action="{{ route('register') }}" class="space-y-4">
@csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required autofocus>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <!-- Address Fields (Minimal for Sign-up, can be detailed later) -->
            <h2 class="text-lg font-semibold pt-4 border-t mt-4">Default Delivery Address</h2>
            <div class="form-group">
                <label for="address_line1">Street Address</label>
                <input type="text" name="delivery_address_line1" id="delivery_address_line1" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="delivery_city" id="delivery_city" required>
            </div>
            <div class="form-group">
                <label for="zip_code">Zip Code</label>
                <input type="text" name="delivery_zip_code" id="delivery_zip_code" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-primary w-full">
                    Register
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm">
            Already registered? <a href="/login" class="text-blue-600 hover:underline">Login here</a>
        </p>
    </div>
</section>


@endsection