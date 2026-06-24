<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $totalPengajuan = PengajuanTenagaKerja::where('user_id', $userId)->count();
        $pendingPengajuan = PengajuanTenagaKerja::where('user_id', $userId)
            ->where('status', 'pending')->count();
        $approvedPengajuan = PengajuanTenagaKerja::where('user_id', $userId)
            ->where('status', 'disetujui')->count();
        $rejectedPengajuan = PengajuanTenagaKerja::where('user_id', $userId)
            ->where('status', 'ditolak')->count();
            
        $recentPengajuan = PengajuanTenagaKerja::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
            
        return view('divisi.dashboard', compact(
            'totalPengajuan', 
            'pendingPengajuan', 
            'approvedPengajuan', 
            'rejectedPengajuan',
            'recentPengajuan'
        ));
    }
}