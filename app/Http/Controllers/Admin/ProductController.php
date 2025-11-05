<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product; // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all products (the menu management view).
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the admin index view
        // The view 'admin.products.index' was created earlier as a placeholder
        return view('admin.products.index', compact('products'));
    }

    // TODO: Implement 'create' and 'store' methods for adding new products
    // TODO: Implement 'edit' and 'update' methods for modifying existing products
    // TODO: Implement 'destroy' method for deleting products
}
