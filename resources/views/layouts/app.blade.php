<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nolan's Bakery - @yield('title', 'Delivered Fresh')</title>
<!-- Placeholder for future CSS link -->
@yield('styles')
<link rel="stylesheet" href="{{ asset('css/bakery.css') }}">
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Primary Site Header and Navigation -->
<header>
    <nav class="main-nav">
        <div class="logo">
            <a href="/" style="display:flex; align-items:center; gap:8px; text-decoration:none">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Nolan's Bakery" style="height:28px; width:auto" />
                <span>Nolan's Bakery</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
            <li><a href="/menu" class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a></li>
            <li><a href="/cart" class="{{ request()->routeIs('cart') ? 'active' : '' }}">Cart</a></li>
            <li><a href="/order" class="btn-primary {{ request()->routeIs('order*') ? 'active' : '' }}">Place Order</a></li>
            <!-- Auth Links - will hide/show based on user session -->
            @guest
                <li><a href="/login" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
            @else
                <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Account</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-tertiary">Logout</button>
                    </form>
                </li>
            @endguest
        </ul>
    </nav>
</header>

<!-- Main Content Area - Page content goes here -->
<main id="content">
    @yield('content')
</main>

<!-- Include the Footer -->
@include('partials.footer')

<!-- Placeholder for page-specific JavaScript -->
@yield('scripts')


</body>
</html>