<?php

namespace App\DataTables;

use App\Models\Layanan;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LayananDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('price', function ($row) {
                $currency =  "Rp." . number_format($row->price, 0, ',', '.');
                return $currency;
            })
            ->rawColumns(['thumbnail', 'action'])
            ->editColumn('thumbnail', function ($row) {
                $url = asset("storage/{$row->thumbnail}");
                $imglink = url("storage/{$row->thumbnail}");
                $img = '<a href="' . $imglink . '"><img src=' . $url . ' height="50px" width="50px"></a>';
                return $img;
            })
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update store/layanans')) {
                    $action = '<button data-id=' . $row->id . ' data-jenis="edit" type="button" class="btn mb-2 btn-primary btn-sm action"><i class="ti-pencil"></i></button>';
                }
                if (Gate::allows('delete store/layanans')) {
                    $action .= ' <button data-id=' . $row->id . ' data-jenis="delete" type="button" class="btn mb-2 btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LayananDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Layanan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->searchDelay(1000)
            ->setTableId('layanan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->dom('Bfrtip')
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::computed('thumbnail'),
            Column::make('description'),
            Column::make('note'),
            Column::make('qty'),
            Column::make('price'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Layanan_' . date('YmdHis');
    }
}
