<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/officer', [OfficerController::class, 'index'])->name('officer.index');
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');

    Route::get('/officer', [OfficerController::class, 'index'])->name('officer.index');
    Route::post('/officer', [OfficerController::class, 'store'])->name('officer.store');
    Route::put('/officer/update/{id}', [OfficerController::class, 'update'])->name('officer.update');
    Route::delete('/officer/{purchaseRequest}', [OfficerController::class, 'destroy'])->name('officer.destroy');

    Route::post('manager/purchase-requests/{purchaseRequest}/approve', [ManagerController::class, 'approve'])->name('manager.approve');
    Route::post('manager/purchase-requests/{purchaseRequest}/reject', [ManagerController::class, 'reject'])->name('manager.reject');
    Route::get('/manager/history', [ManagerController::class, 'history'])->name('manager.history');

    Route::post('/finance/approve/{purchaseRequest}', [FinanceController::class, 'approve'])->name('finance.approve');
    Route::post('/finance/reject/{purchaseRequest}', [FinanceController::class, 'reject'])->name('finance.reject');
    Route::get('/finance/history', [FinanceController::class, 'history'])->name('finance.history');
});

require __DIR__ . '/auth.php';
