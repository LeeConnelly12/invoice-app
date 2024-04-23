<?php

use App\Http\Controllers\DraftInvoiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MarkInvoiceAsPaidController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Invoices
Route::get('/invoices', [InvoiceController::class, 'index'])
    ->name('invoices')
    ->middleware('auth');

Route::post('/invoices', [InvoiceController::class, 'store'])
    ->name('invoices.store')
    ->middleware('auth');

Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])
    ->name('invoices.show')
    ->middleware('auth');

Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])
    ->name('invoices.update')
    ->middleware('auth');

Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])
    ->name('invoices.destroy')
    ->middleware('auth');

Route::post('/draft-invoices', [DraftInvoiceController::class, 'store'])
    ->name('draft-invoices.store')
    ->middleware('auth');

Route::put('/invoices/{invoice}/mark-as-paid', MarkInvoiceAsPaidController::class)
    ->name('invoices.mark-as-paid')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
