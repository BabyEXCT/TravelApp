<?php

namespace App\Http\Controllers;

use App\Models\Refund; // Import the Refund model
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        // Fetch refunds along with related user and package data
        $refunds = Refund::with('user', 'package')->get();

        // Return the view with refunds data
        return view('Admin.refund.index', compact('refunds'));
    }
}
