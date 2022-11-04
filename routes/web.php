<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('add', [UserController::class, 'add'])->name('add');
        Route::get('{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('', [UserController::class, 'store'])->name('store');
        Route::put('update', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('role')->name('role.')->group(function() {
        Route::get('', [RoleController::class, 'index'])->name('index');
        Route::post('', [RoleController::class, 'store'])->name('store');
    });
    Route::prefix('product')->name('product.')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::put('{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('transaction')->name('transaction.')->group(function() {
        Route::get('', [TransactionController::class, 'index'])->name('index');
        Route::get('add', [TransactionController::class, 'add'])->name('add');
        Route::get('detail/{kode}', [TransactionController::class, 'detail'])->name('detail');
        Route::get('{kode}', [TransactionController::class, 'edit'])->name('edit');
        Route::post('', [TransactionController::class, 'store'])->name('store');
        Route::put('{kode}', [TransactionController::class, 'update'])->name('update');
        // Route::delete('{id}', [TransactionController::class, 'destroy'])->name('destroy');
    });
});