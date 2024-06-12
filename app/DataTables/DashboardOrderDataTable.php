<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DashboardOrderDataTable extends DataTable
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
                $payment = route('dashboard.payment', $row->transaction_id);
                $action = '';
                // if (Gate::allows('read payment')) {
                $action =   '<form action="' . $payment . '" method="GET">
                        ' . method_field('GET') . '
                        ' . csrf_field() . '
                        <button data-id=' . $row->transaction_id . ' data-jenis="show" type="submit" class="btn mb-2 btn-primary btn-sm action">Payment</button>
                        </form>';
                // }
                if (Gate::allows('update transaction/orders')) {
                    $action = '<button data-id=' . $row->id . ' data-jenis="edit" type="button" class="btn mb-2 btn-primary btn-sm action"><i class="ti-pencil"></i></button>';
                }
                if (Gate::allows('delete transaction/orders')) {
                    $action .= ' <button data-id=' . $row->id . ' data-jenis="delete" type="button" class="btn mb-2 btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DashboardOrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        $orders = $model->with(['cart', 'user'])->select('orders.*')->newQuery();
        return $orders;
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
            ->setTableId('dashboardOrder-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                // Button::make('create'),
                // Button::make('export'),
                Button::make('pdf'),
                // Button::make('reset'),
                // Button::make('reload')
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
            Column::make('user.name')->title('User')->data('user.name')->orderable(false),
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
        return 'DashboardOrder_' . date('YmdHis');
    }
}
