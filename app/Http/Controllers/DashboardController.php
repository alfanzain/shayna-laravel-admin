<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $income = Transaction::success()
            ->sum('transaction_total');

        $sales = Transaction::count();

        $lastTransactions = Transaction::orderBy('id', 'DESC')
            ->take(5)
            ->get();

        $statusTransactions = [
            'pending' => Transaction::pending()->count(),
            'failed' => Transaction::failed()->count(),
            'success' => Transaction::success()->count(),
        ];

        return view('pages.dashboard.index')->with([
            'income' => $income,
            'sales' => $sales,
            'lastTransactions' => $lastTransactions,
            'statusTransactions' => $statusTransactions
        ]);
    }
}
