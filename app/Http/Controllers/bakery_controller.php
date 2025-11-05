<?php

namespace App\Http\Controllers;

use App\Models\product; // Assuming you have the Product Model
use Illuminate\Http\Request;

class bakery_controller extends Controller
{
    /**
     * Show the application's home page.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the About Us page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the full menu, fetching all available products from the database.
     * The $products variable is passed to menu.blade.php.
     */
    public function menu()
    {
        // This attempts to fetch products and group them by category
        try {
             $products = Product::where('is_available', true)
                                ->orderBy('category')
                                ->get()
                                ->groupBy('category');
        } catch (\Throwable $e) {
            // Rich placeholder data if the database is not yet configured
            $products = collect([
                'CAKES' => collect([
                    (object)['id' => 101, 'name' => 'Classic Chocolate Cake', 'price' => 22.00, 'description' => 'Moist cocoa layers with dark chocolate ganache', 'image_path' => 'images/products/cakes/classic-chocolate-cake.jpg'],
                    (object)['id' => 102, 'name' => 'Vanilla Bean Celebration Cake', 'price' => 20.00, 'description' => 'Madagascar vanilla with silky buttercream', 'image_path' => 'images/products/cakes/vanilla-bean-celebration-cake.jpg'],
                    (object)['id' => 103, 'name' => 'Red Velvet Cake', 'price' => 24.00, 'description' => 'Tangy cream cheese frosting, deep cocoa notes', 'image_path' => 'images/products/cakes/red-velvet-cake.jpg'],
                    (object)['id' => 104, 'name' => 'Carrot Walnut Cake', 'price' => 23.00, 'description' => 'Spiced carrot layers with toasted walnuts', 'image_path' => 'images/products/cakes/carrot-walnut-cake.jpg']
                ]),
                'BREADS' => collect([
                    (object)['id' => 201, 'name' => 'Sourdough Boule', 'price' => 8.00, 'description' => 'Naturally leavened, crackly crust', 'image_path' => 'images/products/breads/sourdough-boule.jpg'],
                    (object)['id' => 202, 'name' => 'Country Baguette', 'price' => 3.50, 'description' => 'Light, open crumb with a crisp crust', 'image_path' => 'images/products/breads/country-baguette.jpg'],
                    (object)['id' => 203, 'name' => 'Whole Wheat Loaf', 'price' => 6.50, 'description' => 'Hearty sandwich bread with honey', 'image_path' => 'images/products/breads/whole-wheat-loaf.jpg'],
                    (object)['id' => 204, 'name' => 'Brioche Rolls (6)', 'price' => 7.50, 'description' => 'Rich, buttery, and soft', 'image_path' => 'images/products/breads/brioche-rolls.jpg']
                ]),
                'PASTRIES' => collect([
                    (object)['id' => 301, 'name' => 'Butter Croissant', 'price' => 3.50, 'description' => 'Flaky layers, buttery finish', 'image_path' => 'images/products/pastries/butter-croissant.jpg'],
                    (object)['id' => 302, 'name' => 'Almond Croissant', 'price' => 4.25, 'description' => 'Frangipane filled, powdered sugar', 'image_path' => 'images/products/pastries/almond-croissant.jpg'],
                    (object)['id' => 303, 'name' => 'Cinnamon Roll', 'price' => 3.75, 'description' => 'Cream cheese glaze', 'image_path' => 'images/products/pastries/cinnamon-roll.jpg'],
                    (object)['id' => 304, 'name' => 'Blueberry Muffin', 'price' => 3.25, 'description' => 'Bursting with berries', 'image_path' => 'images/products/pastries/blueberry-muffin.jpg']
                ]),
            ]);
        }

        return view('menu', compact('products'));
    }

    /**
     * Show the shopping cart view, retrieving actual cart items from the session.
     */
    public function cart()
    {
        $cartItems = session()->get('cart', []);
        
        // This logic is needed if we want to display full product details in the cart
        $productIds = array_keys($cartItems);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        
        // Combine product details with cart quantity
        $cart = collect($cartItems)->map(function ($quantity, $id) use ($products) {
            $product = $products->get($id);
            if ($product) {
                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            }
            return null;
        })->filter()->values();

        return view('cart', ['cart' => $cart]);
    }

    /**
     * Show the checkout/order finalization page.
     */
    public function order()
    {
        // TODO: Validate the user is authenticated and the cart is not empty before showing this page
        return view('order');
    }

    // --- Form Handling Methods ---

    /**
     * Logic to handle adding an item to the cart (POST request).
     */
    public function addToCart(Request $request, $productId)
    {
        // Sanitize the quantity input, defaulting to 1
        $quantity = $request->input('quantity', 1);

        // Get the current cart from the session, default to an empty array
        $cart = session()->get('cart', []);

        // Add the product ID and quantity to the cart
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        return back()->with('success', 'Item added to basket!');
    }

    /**
     * Logic to handle finalizing the order (POST request from /order).
     */
    public function processOrder(Request $request)
    {
        // TODO: Full implementation for validation, payment, and database order creation
        // 1. Validate Delivery and Payment Data
        // 2. Create the Order in the 'orders' table
        // 3. Create records in the 'order_items' table
        // 4. Handle payment processing (e.g., Stripe, PayPal)
        // 5. Clear the cart session
        
        return redirect('/order-confirmation')->with('success', 'Order placed successfully!');
    }
}
