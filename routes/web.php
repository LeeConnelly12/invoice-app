<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
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


// Invoices
Route::get('/', [InvoiceController::class, 'index'])
    ->name('invoices')
    ->middleware('auth');

Route::post('/invoices', [InvoiceController::class, 'store'])
    ->name('invoices.store')
    ->middleware('auth');

Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])
    ->name('invoices.update')
    ->can('update', 'invoice');

Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])
    ->name('invoices.destroy')
    ->can('delete', 'invoice');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
