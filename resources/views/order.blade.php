@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection

@section('title', 'Place Your Order')

@section('content')
<section class="checkout-form-container">
<h1>Complete Your Order</h1>

    <form action="/checkout" method="POST" class="checkout-form">
        @csrf

        <!-- 1. Cart Summary (Placeholder) -->
        <fieldset class="cart-summary-block">
            <legend>Order Summary</legend>
            <div class="cart-item">Item 1: Qty 2 | Total: ₹10.00</div>
            <div class="cart-item">Item 2: Qty 1 | Total: ₹5.00</div>
            <div class="cart-total">Subtotal: ₹15.00</div>
        </fieldset>

        <!-- 2. Delivery Location (Crucial for the business model) -->
        <fieldset class="delivery-details-block">
            <legend>Delivery Information</legend>

            <div class="form-group">
                <label for="address_line1">Street Address</label>
                <input type="text" name="address_line1" id="address_line1" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" required>
            </div>

            <div class="form-group">
                <label for="zip_code">Zip/Postal Code</label>
                <input type="text" name="zip_code" id="zip_code" required>
            </div>

            <div class="form-group">
                <label for="delivery_time">Preferred Delivery Time</label>
                <input type="datetime-local" name="delivery_time" id="delivery_time">
            </div>
        </fieldset>

        <!-- 3. Payment Details (Placeholder) -->
        <fieldset class="payment-block">
            <legend>Payment Details</legend>
            <p>Payment integration will go here (e.g., card input fields, payment gateways).</p>
        </fieldset>

        <button type="submit" class="btn-checkout">Confirm and Pay</button>
    </form>
</section>


@endsection