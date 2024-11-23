<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Store;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:500'],
            'contact' => ['required', 'string', 'max:15'],
            // 'role' => ['required', 'in:kasir,pemilik usaha'],
            'store_name' => ['required', 'string', 'max:255'], // Validasi nama toko
            'store_address' => ['required', 'string', 'max:500'], // Validasi alamat toko
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $store = Store::create([
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'address' => $request->address,
            'contact' => $request->contact,
            'role' => "pemilik usaha",
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_id' => $store->store_id // store_id yang baru dibuat
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
