<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::where('status', 'publikasi')
            ->where('tanggal_selesai', '>=', now())
            ->with('pengajuan.divisi')
            ->latest()
            ->paginate(9);
            
        return view('frontend.index', compact('lowongans'));
    }
    
    public function lowongan(Request $request)
    {
        $query = Lowongan::where('status', 'publikasi')
            ->where('tanggal_selesai', '>=', now())
            ->with('pengajuan.divisi');
            
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('pengajuan', function($sub) use ($search) {
                      $sub->where('posisi', 'like', "%{$search}%")
                          ->orWhereHas('divisi', function($div) use ($search) {
                              $div->where('nama_divisi', 'like', "%{$search}%");
                          });
                  });
            });
        }
        
        $lowongans = $query->latest()->paginate(12);
        
        return view('frontend.lowongan', compact('lowongans'));
    }
    
    public function show(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect()->route('frontend.home')->with('error', 'Lowongan sudah tidak tersedia.');
        }
        
        return view('frontend.detail', compact('lowongan'));
    }
}