@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('title', 'Your Shopping Cart')

@section('content')
<section class="cart-page-container">
<h1 class="text-4xl font-extrabold mb-2">Your Order Basket</h1>
<p class="text-muted mb-8">Freshly baked items, delivered with care. Free delivery over ₹500.</p>

    @php
        // Mock cart data for structural purposes
        $cartItems = [
            ['name' => 'Artisan Sourdough Loaf', 'price' => 7.50, 'qty' => 1, 'id' => 1],
            ['name' => 'Blueberry Muffin (Pack of 4)', 'price' => 12.00, 'qty' => 2, 'id' => 2],
            ['name' => 'Birthday Cake Custom Order Fee', 'price' => 50.00, 'qty' => 1, 'id' => 3],
        ];
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cartItems));
        $deliveryFee = 5.00;
        $total = $subtotal + $deliveryFee;
    @endphp

    <div class="grid grid-cols-3 gap-8">
        <!-- Cart Items List (2/3 width) -->
        <div class="col-span-2 cart-items-list">
            @if (empty($cartItems))
                <div class="empty-cart-message">
                    <p>Your basket is currently empty. <a href="/menu">Start browsing our delicious menu!</a></p>
                </div>
            @else
                @foreach ($cartItems as $item)
                    <div class="cart-item-row flex justify-between items-center py-4 border-b">
                        <div class="item-details flex-grow">
                            <h3 class="font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500">₹{{ number_format($item['price'], 2) }} per item</p>
                        </div>

                        <div class="item-quantity flex items-center space-x-2">
                            <form action="/cart/update/{{ $item['id'] }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-16 text-center border rounded-lg">
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm">Update</button>
                            </form>
                            <form action="/cart/remove/{{ $item['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                            </form>
                        </div>

                        <div class="item-total w-24 text-right font-bold">
                            ₹{{ number_format($item['price'] * $item['qty'], 2) }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Order Summary (1/3 width) -->
        <div class="col-span-1 order-summary-box bg-white p-6 rounded-lg shadow-lg h-fit sticky-summary">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2">Order Summary</h2>
            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between"><span>Subtotal:</span><span class="font-medium">₹{{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span>Delivery Fee:</span><span class="font-medium">₹{{ number_format($deliveryFee, 2) }}</span></div>
                <div class="flex justify-between font-bold text-xl pt-3 border-t-2 mt-2 border-dashed">
                    <span>Estimated Total:</span>
                    <span class="total-amount">₹{{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="promo mt-4">
                <label for="promo" class="block text-sm text-gray-500 mb-1">Have a promo code?</label>
                <div class="flex gap-2">
                    <input id="promo" type="text" class="promo-input" placeholder="Enter code" />
                    <button class="btn-apply">Apply</button>
                </div>
            </div>

            <a href="/order" class="btn-checkout mt-6 w-full text-center block">
                Proceed to Checkout
            </a>

            <a href="/menu" class="text-center block text-sm mt-4 text-blue-600 hover:underline">
                Continue Shopping
            </a>
        </div>
    </div>
</section>


@endsection