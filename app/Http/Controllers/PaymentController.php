<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\Payment;
use App\Helpers\AuthHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DataTables\PaymentDataTable;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create()
    {
        $packages = Package::all();
        return view('Admin.payment.create', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('user.packages.payment', compact('package'));
    }
    public function store(Request $request, $packageId)
    {
        DB::beginTransaction();

        try {
            // Validate payment data
            $request->validate([
                'amount' => 'required|numeric',
                'payment_method' => 'required|string',
                'invoice_number' => 'required|string|unique:payments,invoice_number',
                'payment_date' => 'required|date',
            ]);

            // Log the validation
            Log::info('Payment data validated.');

            // Create the payment
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'package_id' => $packageId,
                'amount' => $request->input('amount'),
                'payment_method' => $request->input('payment_method'),
                'invoice_number' => $request->input('invoice_number'),
                'payment_date' => $request->input('payment_date'),
            ]);

            Log::info('Payment record created:', $payment->toArray());

            // Create the invoice associated with the payment
            $invoice = Invoice::create([
                'payment_id' => $payment->id,
                'user_id' => $payment->user_id,
                'package_id' => $payment->package_id,
                'amount' => $payment->amount,
                'invoice_number' => $payment->invoice_number,
                'status' => 'pending', // You can set the initial status here
                'invoice_date' => $payment->payment_date,
            ]);

            Log::info('Invoice created:', $invoice->toArray());

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('payments.index')->with('success', 'Payment and Invoice created successfully.');
        } catch (\Exception $e) {
            // Rollback transaction if anything fails
            DB::rollBack();
            Log::error('Error creating payment or invoice: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create payment and invoice.']);
        }
    }

    public function index(PaymentDataTable $dataTable)

    {
        $pageTitle = trans('payments.title');  // Assuming you have a translation key 'payments.title' for 'Payment List'
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '';

        return $dataTable->render('global.datatable', compact('pageTitle', 'auth_user', 'assets', 'headerAction'));
    }

    public function Invoiceshow($id)
    {
        $payment = Payment::with('user', 'package')->findOrFail($id);
        return view('user.invoices.show', compact('payment'));
    }

    public function refund()
{
    $refunds = Refund::with('user', 'package')->get(); // Adjust the relationships based on your Refund model
    return view('Admin.refund.index', compact('refunds'));
}

}
