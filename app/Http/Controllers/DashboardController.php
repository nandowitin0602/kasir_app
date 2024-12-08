<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return View('dashboard');
    }

    public function totalSalesToday()
    {
        try {
            $storeId = Auth::user()->store_id;

            $totalSales = Transaction::where('store_id', $storeId)->whereDate('transaction_date', today())->sum('total_price');

            return response()->json([
                'success' => true,
                'totalSales' => 'Rp ' . number_format($totalSales, 0, ',', '.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve total sales today.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function totalSuccessfulTransactionsToday()
    {
        try {
            $storeId = Auth::user()->store_id;

            $totalTransaction = Transaction::where('store_id', $storeId)->whereDate('transaction_date', today())->count();

            return response()->json([
                'success' => true,
                'totalTransaction' => number_format($totalTransaction, 0, ',', '.') . " transactions completed"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve total transaction today.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function outofStockorNearlyOutofStock()
    {
        try {
            $storeId = Auth::user()->store_id;

            $totalItemsRestocking = Item::where('store_id', $storeId)->where('stock', '<=', 2)->count();

            return response()->json([
                'success' => true,
                'totalItemsRestocking' => number_format($totalItemsRestocking, 0, ',', '.') . " items need restocking"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve total transaction today.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function monthlySales()
    {
        try {
            $storeId = Auth::user()->store_id;

            // Ambil 12 bulan terakhir, termasuk bulan saat ini
            $startDate = now()->subMonths(11)->startOfMonth();
            $endDate = now()->endOfMonth();

            // Format labels untuk 12 bulan terakhir
            $labels = [];
            $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $labels[] = $currentDate->format('m/Y');
                $currentDate->addMonth();
            }

            // Hitung total penjualan per bulan
            $sales = Transaction::selectRaw('DATE_FORMAT(transaction_date, "%m/%Y") as month_year, SUM(total_price) as total_sales')
                ->where('store_id', $storeId)
                ->whereBetween('transaction_date', [$startDate, $endDate])
                ->groupBy('month_year')
                ->orderByRaw('STR_TO_DATE(month_year, "%m/%Y")')
                ->pluck('total_sales', 'month_year');

            // Pastikan data lengkap untuk semua bulan
            $salesData = [];
            foreach ($labels as $label) {
                $salesData[] = $sales->get($label, 0);
            }

            return response()->json([
                'labels' => $labels,
                'sales' => $salesData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sales data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function topItems()
    {
        try {
            $storeId = Auth::user()->store_id;

            // Query untuk mendapatkan top 5 best-selling items
            $topItems = TransactionDetail::join('transactions', 'transaction_details.transaction_id', '=', 'transactions.transaction_id')
                ->join('items', 'transaction_details.item_id', '=', 'items.item_id')
                ->select('items.item_name', DB::raw('SUM(transaction_details.quantity) as total_sold'))
                ->where('transactions.store_id', $storeId) // Filter berdasarkan store_id
                ->groupBy('items.item_name') // Kelompokkan berdasarkan item_name
                ->orderByDesc('total_sold') // Urutkan berdasarkan jumlah penjualan terbanyak
                ->limit(5) // Ambil 5 item teratas
                ->get();

            // Siapkan data untuk dikirim ke frontend
            $labels = $topItems->pluck('item_name'); // Nama-nama item
            $sales = $topItems->pluck('total_sold'); // Jumlah terjual per item

            return response()->json([
                'labels' => $labels,
                'sales' => $sales,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve top 5 best-selling data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
