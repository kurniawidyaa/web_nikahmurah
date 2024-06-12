<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\DataTables\UsersDataTable;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $order = Order::whereHas('cart', function ($q) {
            $q->where('status', 'ordered');
        });
        $paid = Payment::where('status', 'capture');
        $unpaid = Payment::where('status', 'pending');
        return view('dashboard', ['user' => $user, 'order' => $order, 'paid' => $paid, 'unpaid' => $unpaid]);
    }

    public function payment(PaymentDataTable $datatables, Request $request)
    {
        $payment = Payment::where('transaction_id', $request->transaction_id)->first();
        return $datatables->render('transaction.payment', [
            'payment' => $payment,
        ]);
    }
}
