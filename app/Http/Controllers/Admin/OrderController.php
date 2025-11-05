<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import the Order model
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of all customer orders.
     */
    public function index()
    {
        // Fetch all orders, ordered by creation date (newest first)
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        // Pass the orders to the admin index view
        // The view 'admin.orders.index' was created earlier as a placeholder
        return view('admin.orders.index', compact('orders'));
    }

    // TODO: Implement 'show' method to view individual order details and items
    // TODO: Implement 'update' method to change the order status (e.g., 'Preparing' to 'Delivered')
}
