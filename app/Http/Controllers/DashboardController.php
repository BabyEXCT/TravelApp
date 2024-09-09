<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // User, Package, and Payment metrics
        $totalUsers = User::count();
        $totalPackages = Package::count();
        $totalPayments = Payment::sum('amount'); // Total Payments

        // Gross Sales and Earnings metrics
        $grossSales = Payment::sum('amount'); // Assuming gross sales are total payments
        $totalEarnings = $grossSales; // You can adjust this if needed
        $transactionCount = Payment::where('status', 'completed')->count();

        // Fetch upcoming packages
        $packages = Package::orderBy('start_date')->take(4)->get(); // Adjust query as needed

        // Prepare data for the chart dynamically
        $grossSalesData = Payment::selectRaw('SUM(amount) as total, strftime("%m", created_at) as month')
                                 ->groupBy('month')
                                 ->orderBy('month')
                                 ->pluck('total')
                                 ->toArray();

        $months = Payment::selectRaw('strftime("%m", created_at) as month')
                         ->groupBy('month')
                         ->orderBy('month')
                         ->pluck('month')
                         ->toArray();

        // Convert month numbers to month names
        $allMonths = ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June',
                       '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];

        $months = array_map(fn($month) => $allMonths[$month] ?? $month, $months);

        // Pad the data to cover all months if needed
        $grossSalesData = array_pad($grossSalesData, 12, 0); // Assuming you want to show data for all 12 months

        // Return view with all data
        return view('Admin.dashboard', compact(
            'totalUsers',
            'totalPackages',
            'totalPayments',
            'grossSales',
            'totalEarnings',
            'transactionCount',
            'grossSalesData',
            'months',
            'packages' // Add packages to the view data
        ));
    }



}


