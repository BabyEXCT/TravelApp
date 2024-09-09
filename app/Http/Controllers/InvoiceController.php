<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UserInvoiceDataTable; // Import the DataTable class

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices.
     *
     * @param UserInvoiceDataTable $dataTable
     * @return \Illuminate\View\View
     */
    public function index(UserInvoiceDataTable $dataTable)
    {
        $pageTitle = trans('invoices.title');  // Use a translation key for the page title
        $auth_user = AuthHelper::authSession(); // Get the authenticated user
        $assets = ['data-table']; // Define assets needed
        $headerAction = '';

        return $dataTable->render('global.datatable', compact('pageTitle', 'auth_user', 'assets', 'headerAction'));
    }

    /**
     * Display the specified invoice.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('user.invoices.show', compact('invoice'));
    }



}



    // Add methods for create, store, edit, update, and delete as needed
