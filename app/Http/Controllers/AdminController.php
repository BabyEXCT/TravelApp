<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch the authenticated user
        $user = Auth::user(); // This gets the currently authenticated user from the users table

        // Check if user is authenticated
        if ($user) {
            // Pass the user and user_type to the view
            return view('Admin.dashboard', [
                'user' => $user,
                'user_type' => $user->user_type,
            ]);
        } else {
            // Handle error or redirect if user is not authenticated
            return redirect()->route('auth.signin')->with('error', 'You need to sign in first!');
        }
    }
}
