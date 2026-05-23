<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\PengajuanTenagaKerja;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hrdId = Auth::id();
        
        $totalLowongan = Lowongan::where('hrd_id', $hrdId)->count();
        $activeLowongan = Lowongan::where('hrd_id', $hrdId)
            ->where('status', 'publikasi')
            ->where('tanggal_selesai', '>=', now())
            ->count();
        $closedLowongan = Lowongan::where('hrd_id', $hrdId)
            ->where('status', 'ditutup')
            ->count();
            
        $totalPelamar = Pelamar::whereHas('lowongan', function($q) use ($hrdId) {
            $q->where('hrd_id', $hrdId);
        })->count();
        
        // Pengajuan yang sudah disetujui dan belum dibuat lowongan
        $pendingLowongan = PengajuanTenagaKerja::with('divisi')
            ->where('status', 'disetujui')
            ->whereDoesntHave('lowongan')
            ->get();
        
        // Statistik status pelamar
        $statStatus = Pelamar::whereHas('lowongan', function($q) use ($hrdId) {
            $q->where('hrd_id', $hrdId);
        })->selectRaw('status, count(*) as total')
          ->groupBy('status')
          ->get();
          
        $recentPelamar = Pelamar::with('lowongan')
            ->whereHas('lowongan', function($q) use ($hrdId) {
                $q->where('hrd_id', $hrdId);
            })
            ->latest()
            ->take(10)
            ->get();
            
        $recentLowongan = Lowongan::where('hrd_id', $hrdId)
            ->latest()
            ->take(5)
            ->get();
            
        return view('hrd.dashboard', compact(
            'totalLowongan', 
            'activeLowongan',
            'closedLowongan',
            'totalPelamar',
            'pendingLowongan',
            'statStatus',
            'recentPelamar',
            'recentLowongan'
        ));
    }
}