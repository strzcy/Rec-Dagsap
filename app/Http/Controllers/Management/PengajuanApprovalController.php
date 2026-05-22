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
        
        if (!$managedDivisiId) {
            // Jika management tidak punya divisi yang ditangani
            return redirect()->route('management.dashboard')
                ->with('error', 'Anda tidak ditugaskan untuk divisi manapun.');
        }
        
        $query = PengajuanTenagaKerja::with(['divisi', 'user'])
            ->where('divisi_id', $managedDivisiId);
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Ambil informasi divisi yang dikelola
        $divisi = Auth::user()->managedDivisi;
        
        return view('management.pengajuan.index', compact('pengajuans', 'divisi'));
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
        
        // Cek apakah management ini berhak mengakses pengajuan ini
        if ($pengajuan->divisi_id !== $managedDivisiId) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini. Anda hanya bisa mengakses pengajuan dari divisi ' . optional(Auth::user()->managedDivisi)->nama_divisi);
        }
        
        return view('management.pengajuan.show', compact('pengajuan'));
    }

    public function approve(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
        
        if ($pengajuan->divisi_id !== $managedDivisiId) {
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
            ->with('success', 'Pengajuan dari divisi ' . $pengajuan->divisi->nama_divisi . ' berhasil disetujui!');
    }

    public function reject(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
        
        if ($pengajuan->divisi_id !== $managedDivisiId) {
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
            ->with('success', 'Pengajuan dari divisi ' . $pengajuan->divisi->nama_divisi . ' ditolak!');
    }
}