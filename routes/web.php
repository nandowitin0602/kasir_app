<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesTransactionController;
use App\Http\Controllers\TransactionReport;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('landing-pages');
});

Route::middleware('guest')->group(function () {
    Route::get('/landing', function () {
        return view('landing');
    })->name('landing-pages');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/store', [ProfileController::class, 'updateStore'])->name('store.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::middleware(CheckRole::class . ':pemilik usaha')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::middleware(CheckRole::class . ':pemilik usaha')->group(function () {
        Route::get('/transaction-report', [TransactionReport::class, 'index'])->name('transaction-report.index');
        Route::get('/transaction-report/{transaction}/details', [TransactionReport::class, 'details'])->name('transaction-report.details');
    });
});

Route::middleware('auth')->group(function () {
    Route::middleware(CheckRole::class . ':kasir')->group(function () {
        Route::get('/item', [ItemController::class, 'index'])->name('item.index');
        Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
        Route::post('/item', [ItemController::class, 'store'])->name('item.store');
        Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
        Route::patch('/item/{item}', [ItemController::class, 'update'])->name('item.update');
        Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::middleware(CheckRole::class . ':kasir')->group(function () {
        Route::get('/sales-transactions', [SalesTransactionController::class, 'index'])->name('sales-transactions.index');
        Route::post('/sales-transactions', [SalesTransactionController::class, 'store'])->name('sales-transactions.store');
    });
});

require __DIR__ . '/auth.php';
