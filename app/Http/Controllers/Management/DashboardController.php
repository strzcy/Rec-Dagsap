<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
        $divisi = Auth::user()->managedDivisi;
        
        if (!$managedDivisiId) {
            return view('management.dashboard', [
                'error' => 'Anda belum ditugaskan untuk mengelola divisi manapun.'
            ]);
        }
        
        // Hanya hitung pengajuan dari divisi yang dikelola
        $totalPengajuan = PengajuanTenagaKerja::where('divisi_id', $managedDivisiId)->count();
        $pendingPengajuan = PengajuanTenagaKerja::where('divisi_id', $managedDivisiId)
            ->where('status', 'pending')->count();
        $approvedPengajuan = PengajuanTenagaKerja::where('divisi_id', $managedDivisiId)
            ->where('status', 'disetujui')->count();
        $rejectedPengajuan = PengajuanTenagaKerja::where('divisi_id', $managedDivisiId)
            ->where('status', 'ditolak')->count();
        
        $recentPengajuan = PengajuanTenagaKerja::with(['user'])
            ->where('divisi_id', $managedDivisiId)
            ->latest()->take(10)->get();
        
        return view('management.dashboard', compact(
            'totalPengajuan', 
            'pendingPengajuan', 
            'approvedPengajuan', 
            'rejectedPengajuan',
            'recentPengajuan',
            'divisi'
        ));
    }
}