<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\User;
use App\Models\Divisi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = PengajuanTenagaKerja::count();
        $pendingPengajuan = PengajuanTenagaKerja::where('status', 'pending')->count();
        $approvedPengajuan = PengajuanTenagaKerja::where('status', 'disetujui')->count();
        $rejectedPengajuan = PengajuanTenagaKerja::where('status', 'ditolak')->count();
        
        $recentPengajuan = PengajuanTenagaKerja::with(['divisi', 'user'])
            ->latest()->take(10)->get();
            
        $totalDivisi = Divisi::count();
        $totalUserDivisi = User::where('role', 'divisi')->count();
        
        // Statistik per divisi
        $statPerDivisi = PengajuanTenagaKerja::selectRaw('divisi_id, count(*) as total')
            ->with('divisi')
            ->groupBy('divisi_id')
            ->get();
            
        return view('management.dashboard', compact(
            'totalPengajuan', 
            'pendingPengajuan', 
            'approvedPengajuan', 
            'rejectedPengajuan',
            'recentPengajuan',
            'totalDivisi',
            'totalUserDivisi',
            'statPerDivisi'
        ));
    }
}