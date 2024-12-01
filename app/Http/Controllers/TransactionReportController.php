<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionReportController extends Controller
{
    // Menampilkan view transactions report
    public function index(Request $request)
    {
        $request->validate([
            'dateTimeAwal' => 'nullable|date_format:Y-m-d',
            'dateTimeAkhir' => 'nullable|date_format:Y-m-d',
        ]);

        $storeId = Auth::user()->store_id; // Ambil store_id dari pengguna yang sedang login

        $query = Transaction::where('store_id', $storeId);

        // Tambahkan filter berdasarkan dateTimeAwal dan dateTimeAkhir jika tidak kosong
        if (!empty($request->dateTimeAwal)) {
            $query->whereDate('transaction_date', '>=', $request->dateTimeAwal);
        }

        if (!empty($request->dateTimeAkhir)) {
            $query->whereDate('transaction_date', '<=', $request->dateTimeAkhir);
        }

        $transactions = $query->get();

        // Hitung jumlah total_price dari transaksi yang sesuai dengan filter
        $totalAllPrice = $query->sum('total_price');

        $totalAllPrice = "Rp " . number_format($totalAllPrice, 0, ',', '.');

        return view('transaction-report.index', compact('transactions', 'totalAllPrice'));
    }


    // Menampilkan view transactions report details
    public function details(Transaction $transaction)
    {
        $transaction_details = TransactionDetail::where('transaction_id', $transaction->transaction_id)->get();
        $transaction_id = $transaction->transaction_id;

        return view('transaction-report.details', compact('transaction_details', 'transaction_id'));
    }
}
