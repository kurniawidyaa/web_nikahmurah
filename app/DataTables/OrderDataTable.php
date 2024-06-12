<?php

namespace App\DataTables;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
            ->editColumn('total', function ($row) {
                $currency = number_format($row->cart->total, 0, ',', '.');
                return $currency;
            })
            ->addColumn('action', function ($row) {
                $order = route('order.show', $row->transaction_id);
                $payment = route('payment.show', $row->transaction_id);

                $action = '';
                // if (Gate::allows('read orders')) {
                //     $action =   ' <form action="' . $order . '" method="GET">
                //                 ' . method_field('GET') . '
                //                 ' . csrf_field() . '
                //                 <button data-id=' . $row->id . ' data-jenis="show" type="submit" class="btn mb-2 btn-primary btn-sm action">Show</button>
                //                 </form> ';
                // }
                if (Gate::allows('read payment')) {
                    $action .=   '<form action="' . $payment . '" method="GET">
                            ' . method_field('GET') . '
                            ' . csrf_field() . '
                            <button data-id=' . $row->transaction_id . ' data-jenis="show" type="submit" class="btn mb-2 btn-primary btn-sm action">Payment</button>
                            </form>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        $order = $model->with(['cart'])->where('user_id', Auth::user()->id)->select('orders.*')->newQuery();
        // $cart = $model->where('user_id', Auth::user()->id)->select('carts.*')->newQuery();
        return $order;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->dom('Bftrip')
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
            Column::make('transaction_id')->title('Id Transaksi')->data('transaction_id')->orderable(false),
            Column::make('cart.event_date')->title('Tanggal Acara')->data('cart.event_date'),
            Column::make('cart.status')->title('Status Pesanan')->data('cart.status'),
            Column::make('jml_cicilan')->title('Jumlah Cicilan')->data('jml_cicilan'),
            Column::make('cart.total')->title('Total (Rp)')->data('cart.total')->name('total')->orderable(false),
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
        return 'Order_' . date('YmdHis');
    }
}
