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
        // Management hanya melihat pengajuan dari divisi yang mereka tangani
        $managedDivisiId = Auth::user()->managed_divisi_id;
        
        $query = PengajuanTenagaKerja::with(['divisi', 'user'])
            ->where('divisi_id', $managedDivisiId);
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('management.pengajuan.index', compact('pengajuans'));
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        // Cek apakah management ini berhak mengakses pengajuan ini
        if ($pengajuan->divisi_id !== Auth::user()->managed_divisi_id) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }
        
        return view('management.pengajuan.show', compact('pengajuan'));
    }

    public function approve(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        if ($pengajuan->divisi_id !== Auth::user()->managed_divisi_id) {
            abort(403);
        }
        
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
        if ($pengajuan->divisi_id !== Auth::user()->managed_divisi_id) {
            abort(403);
        }
        
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