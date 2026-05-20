<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = PengajuanTenagaKerja::count();
        $pendingPengajuan = PengajuanTenagaKerja::where('status', 'pending')->count();
        $approvedPengajuan = PengajuanTenagaKerja::where('status', 'disetujui')->count();
        $rejectedPengajuan = PengajuanTenagaKerja::where('status', 'ditolak')->count();
        $recentPengajuan = PengajuanTenagaKerja::with('divisi')->latest()->take(10)->get();
        
        return view('management.dashboard', compact('totalPengajuan', 'pendingPengajuan', 'approvedPengajuan', 'rejectedPengajuan', 'recentPengajuan'));
    }
}