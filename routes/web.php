<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Divisi\DashboardController as DivisiDashboardController;
use App\Http\Controllers\Divisi\PengajuanController;
use App\Http\Controllers\Management\DashboardController as ManagementDashboardController;
use App\Http\Controllers\Management\PengajuanApprovalController;
use App\Http\Controllers\HRD\DashboardController as HRDDashboardController;
use App\Http\Controllers\HRD\LowonganController;
use App\Http\Controllers\HRD\PelamarController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\Frontend\ApplyController;
use App\Http\Controllers\HRD\DataPtkController;


/*
|--------------------------------------------------------------------------
| Frontend Routes (Public - No Login Required)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('frontend.home');
Route::get('/lowongan', [LandingController::class, 'lowongan'])->name('frontend.lowongan');
Route::get('/lowongan/{lowongan}/detail', [ApplyController::class, 'detail'])->name('frontend.detail');
Route::get('/lowongan/{lowongan}/apply', [ApplyController::class, 'index'])->name('frontend.apply');
Route::post('/lowongan/{lowongan}/apply', [ApplyController::class, 'store'])->name('frontend.apply.store');
Route::get('/apply/success/{pelamar}', [ApplyController::class, 'success'])->name('frontend.apply.success')->middleware('signed');
Route::get('/apply/detail/{pelamar}', [ApplyController::class, 'detailForm'])->name('frontend.apply.detail_form')->middleware('signed');
Route::post('/apply/detail/{pelamar}', [ApplyController::class, 'storeDetail'])->name('frontend.apply.store_detail')->middleware('signed');
Route::get('/apply/failed', [ApplyController::class, 'failed'])->name('frontend.apply.failed');
Route::get('/psikotest/{pelamar}', [ApplyController::class, 'psikotest'])->name('frontend.apply.psikotest')->middleware('signed');
Route::post('/psikotest/{pelamar}', [ApplyController::class, 'submitPsikotest'])->name('frontend.apply.submit_psikotest')->middleware('signed');
/*
|--------------------------------------------------------------------------
| Admin Routes (Login Required)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post')->middleware('throttle:5,1');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes (Must be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Divisi Routes
    Route::middleware(['check.role:divisi'])->prefix('divisi')->name('divisi.')->group(function () {
        Route::get('/dashboard', [DivisiDashboardController::class, 'index'])->name('dashboard');
    
        // Verifikasi NIK untuk riwayat
        Route::get('/pengajuan/verify', [PengajuanController::class, 'verifyForm'])->name('pengajuan.verify');
        Route::post('/pengajuan/verify', [PengajuanController::class, 'verify'])->name('pengajuan.verify.post');
    
        Route::resource('pengajuan', PengajuanController::class)->except(['index']);
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    });
    
    // Management Routes
    Route::middleware(['check.role:management'])->prefix('management')->name('management.')->group(function () {
        Route::get('/dashboard', [ManagementDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pengajuan', [PengajuanApprovalController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{pengajuan}', [PengajuanApprovalController::class, 'show'])->name('pengajuan.show');
        Route::post('/pengajuan/{pengajuan}/approve', [PengajuanApprovalController::class, 'approve'])->name('pengajuan.approve');
        Route::post('/pengajuan/{pengajuan}/reject', [PengajuanApprovalController::class, 'reject'])->name('pengajuan.reject');
        Route::get('/pengajuan/{pengajuan}/print', [PengajuanApprovalController::class, 'printData'])->name('pengajuan.print');
    });
    
    // HRD Routes
    Route::middleware(['check.role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
        Route::get('/dashboard', [HRDDashboardController::class, 'index'])->name('dashboard');
        Route::resource('lowongan', LowonganController::class);
        Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
        Route::get('/pelamar/{pelamar}', [PelamarController::class, 'show'])->name('pelamar.show');
        Route::post('/pelamar/{pelamar}/kirim-interview', [PelamarController::class, 'kirimJadwalInterview'])->name('pelamar.kirim-interview');
        Route::post('/pelamar/{pelamar}/update-status', [PelamarController::class, 'updateStatus'])->name('pelamar.update-status');
        Route::get('/pelamar/{pelamar}/download-cv', [PelamarController::class, 'downloadCv'])->name('pelamar.download-cv');
        Route::get('/pelamar/{pelamar}/download-ijazah', [PelamarController::class, 'downloadIjazah'])->name('pelamar.download-ijazah');
        Route::get('/pelamar/{pelamar}/preview-cv', [PelamarController::class, 'previewCv'])->name('pelamar.preview-cv');
        Route::get('/pelamar/{pelamar}/preview-ijazah', [PelamarController::class, 'previewIjazah'])->name('pelamar.preview-ijazah');
        Route::get('/pelamar/{pelamar}/print', [PelamarController::class, 'printData'])->name('pelamar.print');
        Route::get('/lowongan/{lowongan}/print', [LowonganController::class, 'printData'])->name('lowongan.print');
        // Data PTK
        Route::get('/ptk', [DataPtkController::class, 'index'])->name('ptk.index');
        Route::get('/ptk/{ptk}', [DataPtkController::class, 'show'])->name('ptk.show');
        Route::get('/ptk/{ptk}/print', [DataPtkController::class, 'printData'])->name('ptk.print'); 
        
    });

    
});