<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanTenagaKerja::with(['divisi', 'user']);
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('management.pengajuan.index', compact('pengajuans'));
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        return view('management.pengajuan.show', compact('pengajuan'));
    }

    public function approve(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses sebelumnya!');
        }

        $pengajuan->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('management.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disetujui!');
    }

    public function reject(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses sebelumnya!');
        }

        $pengajuan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->route('management.pengajuan.index')
            ->with('success', 'Pengajuan ditolak!');
    }
}