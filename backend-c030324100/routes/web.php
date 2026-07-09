<?php
// Naufal Elghani C030324100
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

// Rute Login
Route::get('/login', [WebController::class, 'showLogin'])->name('login');
Route::post('/login', [WebController::class, 'login']);

// Rute yang memerlukan Auth
Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebController::class, 'logout'])->name('logout');
    Route::get('/pesan', [WebController::class, 'showPesan'])->name('pesan');
    Route::post('/pesan', [WebController::class, 'storePesan'])->name('pesan.store');
    Route::get('/riwayat', [WebController::class, 'showRiwayat'])->name('riwayat');
});

// Redirect root ke pesan atau login
Route::get('/', function () {
    return redirect()->route('pesan');
});