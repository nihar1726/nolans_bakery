<?php

use Illuminate\Support\Facades\Route;
// Assumed standard auth controllers (these would exist if you use Laravel Breeze/Jetstream)
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\bakery_controller;

/*
|--------------------------------------------------------------------------
| Public Bakery Routes (Nolan's Bakery Website)
|--------------------------------------------------------------------------
*/

Route::controller(bakery_controller::class)->group(function () {
    // Basic informational pages
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/menu', 'menu')->name('menu');

    // Cart operations
    Route::get('/cart', 'cart')->name('cart');
    // POST route to add an item to the session-based cart
    Route::post('/cart/add/{productId}', 'addToCart')->name('cart.add'); 
});


/*
|--------------------------------------------------------------------------
| Checkout Routes (Protected by Auth Middleware)
|--------------------------------------------------------------------------
| These require the user to be logged in to access.
*/
Route::middleware('auth')->group(function () {
    Route::get('/order', [bakery_controller::class, 'order'])->name('order');
    Route::post('/order', [bakery_controller::class, 'processOrder'])->name('order.process');
    
    // Simple placeholder route for confirmation after a successful order
    Route::get('/order-confirmation', function () {
        return view('order-confirmation'); 
    })->name('order.confirmation');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| These routes handle the forms we created in resources/views/auth.
*/

// Registration Routes
// Use real controllers if installed (Breeze/Jetstream). Otherwise, provide safe fallbacks.
if (class_exists(RegisteredUserController::class)) {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
} else {
    // Optional: serve a view if it exists to avoid 404s when controllers are absent
    Route::view('/register', 'auth.register')->name('register');
}

// Login/Logout Routes
// Use real controllers if installed (Breeze/Jetstream). Otherwise, provide safe fallbacks.
if (class_exists(AuthenticatedSessionController::class)) {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
} else {
    Route::view('/login', 'auth.login')->name('login');
    // Provide a no-op logout route to prevent missing route errors in views
    Route::post('/logout', function () {
        return redirect()->route('home');
    })->name('logout');
}


/*
|--------------------------------------------------------------------------
| Admin Routes (Placeholder for Management)
|--------------------------------------------------------------------------
*/
// These are currently unprotected and need proper security later.
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // These controllers (Admin\ProductController, Admin\OrderController) need to be created.
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
});
