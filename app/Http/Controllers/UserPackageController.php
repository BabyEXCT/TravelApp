<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UserInvoiceDataTable;

class UserPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('slots')->get();
        $assets = ['data-table'];

        return view('user.packages.index', compact('packages', 'assets'));
    }

    public function show($id)
    {
        $package = Package::with('slots')->findOrFail($id);
        return view('user.packages.show', compact('package'));
    }

// Show payment form
public function showPaymentForm($packageId)
{
    $package = Package::findOrFail($packageId);
    return view('user.packages.payment', compact('package'));
}

// Process payment
public function processPayment(Request $request, $packageId)
{
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string',
    ]);

    $payment = new Payment();
    $payment->user_id = auth()->id();
    $payment->package_id = $packageId;
    $payment->amount = $validated['amount'];
    $payment->payment_method = $validated['payment_method'];
    $payment->invoice_number = 'INV-' . strtoupper(Str::random(8));
    $payment->payment_date = now();
    $payment->save();

    return redirect()->route('user.packages.payment-success', $packageId)
                     ->with('success', 'Payment successfully processed!');
}


public function paymentSuccess($packageId)
{
    $package = Package::findOrFail($packageId);

    return view('user.packages.payment-success', compact('package'));
}

public function TableInvoice(UserInvoiceDataTable $dataTable)
{
    return $dataTable->render('user.invoices.index');
}


}

