<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display the user's dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch the authenticated user
        $user = auth()->user();

        // Fetch the packages associated with the user
        $packages = Package::where('user_id', $user->id)->get();

        // Fetch the payments made by the user
        $payments = Payment::where('user_id', $user->id)->get();

        // Calculate any other metrics you want to display on the dashboard

        // Return the user dashboard view with the relevant data
        return view('user.dashboard', compact('user', 'packages', 'payments'));
    }
}
