<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            // Add the required delivery fields for validation
            'delivery_address_line1' => ['required', 'string', 'max:255'],
            'delivery_city' => ['required', 'string', 'max:100'],
            'delivery_zip_code' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Map the delivery fields to the user record
            'delivery_address_line1' => $request->delivery_address_line1,
            'delivery_address_line2' => $request->delivery_address_line2,
            'delivery_city' => $request->delivery_city,
            'delivery_zip_code' => $request->delivery_zip_code,
        ]);

        Auth::login($user);

        // Redirect to the home page or a desired post-registration page
        return redirect(route('home'));
    }
}
