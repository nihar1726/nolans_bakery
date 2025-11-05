@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('title', 'Login to Your Account')

@section('content')
<section class="auth-container">
<h1 class="text-3xl font-bold mb-6 text-center">Welcome Back!</h1>
<div class="form-card">
<form method="POST" action="{{ route('login') }}" class="space-y-4">
@csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required autofocus>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm">Remember me</label>
                </div>

                <a href="/forgot-password" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-primary w-full">
                    Login
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm">
            Don't have an account? <a href="/register" class="text-blue-600 hover:underline">Sign up here</a>
        </p>
    </div>
</section>


@endsection