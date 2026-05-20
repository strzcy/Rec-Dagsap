<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = PengajuanTenagaKerja::where('divisi_id', Auth::user()->divisi_id)->count();
        $pendingPengajuan = PengajuanTenagaKerja::where('divisi_id', Auth::user()->divisi_id)
            ->where('status', 'pending')->count();
        $approvedPengajuan = PengajuanTenagaKerja::where('divisi_id', Auth::user()->divisi_id)
            ->where('status', 'disetujui')->count();
        $recentPengajuan = PengajuanTenagaKerja::where('divisi_id', Auth::user()->divisi_id)
            ->latest()->take(5)->get();
            
        return view('divisi.dashboard', compact('totalPengajuan', 'pendingPengajuan', 'approvedPengajuan', 'recentPengajuan'));
    }
}