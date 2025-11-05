@extends('layouts.app')

@section('content')

<div class="container mx-auto max-w-2xl py-20 px-4">
<!-- Success Card -->
<div class="bg-white p-8 rounded-xl shadow-2xl border-t-4 border-amber-600">
<div class="flex flex-col items-center text-center">
<!-- Icon -->
<svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

        <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Placed Successfully!</h1>
        
        <p class="text-lg text-gray-600 mb-6">
            Thank you for choosing Nolan's Bakery. Your order is being prepared with the utmost care and will be delivered to your address shortly.
        </p>

        <p class="text-sm text-gray-500 mb-8">
            A confirmation email with your order details has been sent to your inbox.
        </p>

        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700 transition duration-300 shadow-md">
            Browse More Delicious Goods
        </a>
    </div>
</div>


</div>
@endsection