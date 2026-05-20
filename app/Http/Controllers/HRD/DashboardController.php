<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Pelamar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLowongan = Lowongan::where('hrd_id', auth()->id())->count();
        $activeLowongan = Lowongan::where('hrd_id', auth()->id())->where('status', 'publikasi')->count();
        $totalPelamar = Pelamar::whereHas('lowongan', function($q) {
            $q->where('hrd_id', auth()->id());
        })->count();
        $recentPelamar = Pelamar::with('lowongan')->whereHas('lowongan', function($q) {
            $q->where('hrd_id', auth()->id());
        })->latest()->take(10)->get();
        
        return view('hrd.dashboard', compact('totalLowongan', 'activeLowongan', 'totalPelamar', 'recentPelamar'));
    }
}