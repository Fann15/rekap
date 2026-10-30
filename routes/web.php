<?php

use App\Http\Controllers\{ProfileController,DashboardController,DataPerizinanController,RekapController,KinerjaController,ExportController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('data-perizinan', DataPerizinanController::class)->except('show');
    Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja.index');
    Route::post('/kinerja', [KinerjaController::class, 'store'])->name('kinerja.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','role:admin'])->group(function(){ Route::patch('/data-perizinan/{dataPerizinan}/verifikasi',[DataPerizinanController::class,'verify'])->name('data-perizinan.verify'); Route::get('/rekap',[RekapController::class,'index'])->name('rekap.index'); Route::get('/export/pdf',[ExportController::class,'pdf'])->name('export.pdf'); Route::get('/export/excel',[ExportController::class,'excel'])->name('export.excel'); });

require __DIR__.'/auth.php';
