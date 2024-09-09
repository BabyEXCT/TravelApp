<?php
namespace App\DataTables;

use App\Models\Invoice;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserInvoiceDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('user_name', function ($query) {
                return $query->user ? $query->user->first_name . ' ' . $query->user->last_name : 'N/A';
            })
            ->addColumn('package_name', function ($query) {
                return $query->package ? $query->package->name : 'N/A';
            })
            ->editColumn('amount', function ($query) {
                return number_format($query->amount, 2);
            })
            ->editColumn('invoice_date', function ($query) {
                return $query->invoice_date ? $query->invoice_date->format('Y/m/d') : 'N/A';
            })
            ->addColumn('action', 'invoices.action')
            ->rawColumns(['action']);
    }

    public function query()
    {
        return Invoice::with(['user', 'package'])->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('invoiceTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
            ->parameters([
                "processing" => true,
                "autoWidth" => false,
            ]);
    }

    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'user_name', 'name' => 'user_name', 'title' => 'User Name'],
            ['data' => 'package_name', 'name' => 'package_name', 'title' => 'Package Name'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'invoice_date', 'name' => 'invoice_date', 'title' => 'Invoice Date'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];
    }
}

