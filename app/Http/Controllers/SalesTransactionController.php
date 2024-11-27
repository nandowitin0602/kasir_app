<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
}
