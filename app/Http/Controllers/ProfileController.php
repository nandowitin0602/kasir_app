<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'store' => $request->user()->store,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the store's information.
     */
    public function updateStore(Request $request): RedirectResponse
    {
        $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'store_address' => ['required', 'string', 'max:500'],
        ]);

        // Mengambil user yang sedang login dan memperbarui data store
        $store = $request->user()->store;

        // Memperbarui data store dengan input dari request
        $store->store_name = $request->input('store_name');
        $store->store_address = $request->input('store_address');

        // Menyimpan perubahan pada store
        $store->save();

        return Redirect::route('profile.edit')->with('status', 'store-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Cari dan hapus data di tabel store berdasarkan store_id user
        $storeId = $user->store_id;
        if ($storeId) {
            User::where('store_id', $storeId)->delete();

            Store::where('store_id', $storeId)->delete();
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
