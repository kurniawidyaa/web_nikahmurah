<?php

namespace App\DataTables;

use App\Models\Galeri;
use App\Models\KategoriLayanan;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GaleriDataTable extends DataTable
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
            ->editColumn('category_id', function ($row) {
                $kategori = KategoriLayanan::where('id', $row->category_id)->first();
                return $kategori->name;
            })
            ->rawColumns(['thumbnail', 'action'])
            ->editColumn('thumbnail', function ($row) {
                $url = asset("storage/{$row->thumbnail}");
                $imglink = url("storage/{$row->thumbnail}");
                $img = '<a href="' . $imglink . '"><img src=' . $url . ' height="50px" width="50px"></a>';
                return $img;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update store/galeris')) {
                    $action = '<button data-id=' . $row->id . ' data-jenis="edit" type="button" class="btn mb-2 btn-primary btn-sm action"><i class="ti-pencil"></i></button>';
                }
                if (Gate::allows('delete store/galeris')) {
                    $action .= ' <button data-id=' . $row->id . ' data-jenis="delete" type="button" class="btn mb-2 btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GaleriDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Galeri $model)
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
            ->setTableId('galeri-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1);
        // ->buttons(
        //     Button::make('create'),
        //     Button::make('export'),
        //     Button::make('print'),
        //     Button::make('reset'),
        //     Button::make('reload')
        // );
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
            Column::make('category_id')->title('Kategori'),
            Column::make('thumbnail'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
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
        return 'Galeri_' . date('YmdHis');
    }
}
