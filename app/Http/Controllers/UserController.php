<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan daftar user dengan role kasir
    public function index()
    {
        $storeId = Auth::user()->store_id; // Ambil store_id dari pengguna yang sedang login

        $users = User::where('role', 'kasir')
            ->where('store_id', $storeId)  // Menambahkan kondisi store_id
            ->get();

        return view('user.index', compact('users'));
    }

    // Menampilkan halaman untuk menambah user
    public function create()
    {
        return view('user.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'address' => 'required|string|max:500',
            'contact' => 'required|string|max:20',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->role = 'kasir';
        $user->store_id = Auth::user()->store_id;
        $user->password = bcrypt('12345678'); // Password default 12345678

        $user->save();

        return redirect()->route('user.index')->with('success', 'User added successfully!');
    }

    // Menampilkan form untuk mengedit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'address' => 'required|string|max:500',
            'contact' => 'required|string|max:20',
        ]);

        // Perbarui data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
        ]);

        return redirect()->route('user.index')->with('status', 'User updated successfully.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('status', 'User deleted successfully.');
    }
}
