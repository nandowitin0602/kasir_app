<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // Menampilkan daftar item
    public function index()
    {
        $storeId = Auth::user()->store_id; // Ambil store_id dari pengguna yang sedang login

        $items = Item::where('store_id', $storeId)->get();

        return view('item.index', compact('items'));
    }

    // Menampilkan halaman untuk menambah item
    public function create()
    {
        return view('item.create');
    }

    // Menyimpan item baru
    public function store(Request $request)
    {
        $cleaned_price = str_replace('.', '', $request->item_price);

        $request->validate([
            'item_code' => 'required|string|max:50|unique:items,item_code',
            'item_name' => 'required|string|max:200',
            'item_price' => 'required',
            'stock' => 'required|numeric|between:0,99999999.99',
        ]);

        $item = new Item();
        $item->item_code = $request->item_code;
        $item->item_name = $request->item_name;
        $item->item_price = $cleaned_price;
        $item->selling_unit = $request->selling_unit;
        $item->stock = $request->stock;
        $item->store_id = Auth::user()->store_id;
        
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item added successfully!');
    }

    // Menampilkan form untuk mengedit item
    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    // Update data item
    public function update(Request $request, Item $item)
    {
        $cleaned_price = str_replace('.', '', $request->item_price);

        $request->validate([
            'item_code' => 'required|string|max:50|unique:items,item_code,' . $item->item_id . ',item_id',
            'item_name' => 'required|string|max:200',
            'item_price' => 'required',
            'stock' => 'required|numeric|between:0,99999999.99',
        ]);

        // Perbarui data item
        $item->update([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'item_price' => $cleaned_price,
            'selling_unit' => $request->selling_unit,
            'stock' => $request->stock,
        ]);

        return redirect()->route('item.index')->with('status', 'Item updated successfully.');
    }

    // Hapus item
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')->with('status', 'Item deleted successfully.');
    }
}
