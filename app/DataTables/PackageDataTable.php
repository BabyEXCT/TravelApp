<?php

namespace App\DataTables;

use datatables;
use App\Models\Package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PackageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
{
    return datatables()
        ->eloquent($query)
        ->editColumn('price', function($query) {
            return number_format($query->price, 2);
        })
        ->editColumn('status', function($query) {
            $status = 'warning';
            switch ($query->status) {
                case 'available':
                    $status = 'success';
                    break;
                case 'unavailable':
                    $status = 'danger';
                    break;
                case 'pending':
                    $status = 'info';
                    break;
            }
            return '<span class="text-capitalize badge bg-'.$status.'">'.$query->status.'</span>';
        })
        ->editColumn('created_at', function($query) {
            return date('Y/m/d', strtotime($query->created_at));
        })
        ->addColumn('slots', function($query) {
            $slots = $query->slots->map(function($slot) {
                return 'Slots: '.$slot->available_slots;
            })->implode('<br>');

            return $slots ? $slots : 'No slots available';
        })
        ->filterColumn('name', function($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->filterColumn('status', function($query, $keyword) {
            return $query->where('status', 'like', "%{$keyword}%");
        })
        ->addColumn('action', 'Admin.package.action')
        ->rawColumns(['action', 'status', 'slots']);
}

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Package::query();
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
                    ->parameters([
                        "processing" => true,
                        "autoWidth" => false,
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
{
    return [
        ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
        ['data' => 'name', 'name' => 'name', 'title' => 'Package Name'],
        ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
        ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ['data' => 'slots', 'name' => 'slots', 'title' => 'Slots'], // New column for slots
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Creation Date'],
        Column::computed('action')
              ->exportable(false)
              ->printable(false)
              ->searchable(false)
              ->width(60)
              ->addClass('text-center hide-search'),
    ];
}

}
