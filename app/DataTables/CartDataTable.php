<?php

namespace App\DataTables;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CartDataTable extends DataTable
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
            ->editColumn('price', function ($row) {
                $currency =  "Rp" . number_format($row->price, 0, ',', '.');
                return $currency;
            })
            ->editColumn('subtotal', function ($row) {
                $currency =  "Rp" . number_format($row->subtotal, 0, ',', '.');
                return $currency;
            })
            ->editColumn('qty', function ($row) {
                $route = route('cart_item.update', $row->id);
                $form = '<div class="btn-group" role="group">
                        <form action="' . $route . '" method="post">
                          ' . method_field('patch') . '
                          ' . csrf_field() . '
                            <input type="hidden" name="kurang" value="' . $row->qty . '">
                            <button class="btn btn-primary btn-sm">
                            -
                            </button>
                          </form>
                          <input class="text-center" style="width:30px; height:30px; type="text" name="qty" value=' . $row->qty . '>
                          <form action="' . $route . '" method="post">
                          ' . method_field('patch') . '
                          ' . csrf_field() . '
                            <input type="hidden" name="tambah" value="' . $row->qty . '">
                            <button class="btn btn-primary btn-sm">
                            +
                            </button>
                          </form>
                          </div>';
                return $form;
            })
            ->addColumn('action', function ($row) {
                $action = ' <button data-id=' . $row->id . ' data-jenis="delete" type="button" class="btn mb-2 btn-danger btn-sm action">Hapus</button>';

                return $action;
            })
            ->rawColumns(['action', 'qty']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CartDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CartItem $model)
    {
        return $model->with(['layanans'])->select('cart_items.*')->newQuery();
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
            ->setTableId('cart-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('layanans.name')->title('Layanan')->data('layanans.name')->name('layanans.name')->orderable(false),
            Column::make('price')->title('Harga'),
            Column::computed('qty')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center')
                ->orderable(false),
            Column::make('subtotal'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center')
                ->orderable(false)
                ->title('Aksi'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Cart_' . date('YmdHis');
    }
}
