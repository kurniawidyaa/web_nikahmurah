<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $order = route('order.show', $row->payment_id);
                $action = '';
                if ($row->status == 'lunas') {
                    $action = '<a href=" ' . $row->link . '" style="display:none" class="btn btn-primary text-white text-center btn-show">Pay</a>';
                }
                $action = '<div class="column"><a href=" ' . $row->link . '" class="btn btn-primary text-white text-center btn-show mb-3">Pay</a>';

                if ($row->status == 'lunas') {
                    $action .= '<a href="' . $order . '" class="btn btn-primary text-white text-center btn-show">Quotation</a></div>';
                }
                $action .= '<a href="' . $order . '" class="btn btn-primary text-white text-center btn-show" style="display:none">Quotation</a></div>';

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PaymentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model, Request $request)
    {
        // return $model->where('order_id', $id)->select('payments.*')->newQuery();
        return $model->where('transaction_id', $request->transaction_id)->select('payments.*')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('payment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make('payment_id')->title('Id Pembayaran')->orderable(false),
            Column::make('type')->title('Jenis Pembayaran')->orderable(false),
            Column::make('due_date')->title('Tgl Jatuh Tempo')->orderable(false),
            Column::make('amount')->title('Jumlah')->orderable(false),
            Column::make('status')->title('Status Pembayaran')->orderable(false),
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
        return 'Payment_' . date('YmdHis');
    }
}
