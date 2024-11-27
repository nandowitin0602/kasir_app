<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesTransactionController extends Controller
{
    // Menampilkan view sales transactions
    public function index()
    {
        $storeId = Auth::user()->store_id; // Ambil store_id dari pengguna yang sedang login

        $items = Item::where('store_id', $storeId)
            ->where('is_deleted', 'n')
            ->get();

        return view('sales-transactions.index', compact('items'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'total_price' => 'required|numeric|between:1,99999999.99',
            'quantity.*' => 'required|numeric',
            'item_code.*' => 'required|string',
        ]);

        // Simpan data ke tabel transactions
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->user_id;
        $transaction->total_price = $request->total_price;
        $transaction->transaction_date = date('Y-m-d H:i:s');
        $transaction->store_id = Auth::user()->store_id;
        $transaction->save();

        // Simpan data ke tabel transaction_details
        foreach ($request->item_code as $index => $itemCode) {
            // Cari item berdasarkan item_code
            $item = Item::where('item_code', $itemCode)->first();

            if ($item) {
                // Buat instance baru untuk detail transaksi
                $transaction_detail = new TransactionDetail();
                $transaction_detail->transaction_id = $transaction->transaction_id;
                $transaction_detail->item_id = $item->item_id;
                $transaction_detail->quantity = $request->quantity[$index];
                $transaction_detail->total_price = $item->item_price * $request->quantity[$index];
                $transaction_detail->save();

                // Update stok item
                if ($item->stock >= $request->quantity[$index]) {
                    $item->stock -= $request->quantity[$index];
                    $item->save(); // Simpan perubahan stok
                } else {
                    return redirect()->route('sales-transactions.index')->with('error', 'Insufficient stock for item code ' . $itemCode);
                }
            } else {
                return redirect()->route('sales-transactions.index')->with('error', 'Item code not found.');
            }
        }

        return redirect()->route('sales-transactions.index')->with('success', 'Sales Transaction Successful !');
    }
}
