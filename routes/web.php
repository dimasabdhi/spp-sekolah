<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//login dan logout
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/admin', function () {
    return view('admin');
})->middleware('role:admin');

Route::get('/student', function () {
    return view('student');
})->middleware('role:student');

//midtrans
Route::get('/reports', [ReportController::class, 'index'])->middleware('role:admin');


//angsuran
Route::middleware('auth')->group(function () {
    Route::get('/payments/{payment}/installments/create', [InstallmentController::class, 'create'])->name('installments.create');
    Route::post('/payments/{payment}/installments', [InstallmentController::class, 'store'])->name('installments.store');
});

Route::post('/midtrans/callback', [PaymentController::class, 'paymentCallback']);

//histori pembayaran
Route::get('/payment-history', [PaymentHistoryController::class, 'index'])->middleware('auth')->name('payment.history');

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/yearly', [ReportController::class, 'yearly'])->name('reports.yearly');
});

Route::get('/payment-history', [PaymentHistoryController::class, 'index'])->middleware('auth')->name('payment.history');

//cetak pdf
Route::get('/pdf/payment-history', [PDFController::class, 'generatePDF'])->middleware('auth')->name('pdf.payment.history');
