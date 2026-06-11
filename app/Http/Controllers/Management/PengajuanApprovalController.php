<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PengajuanApprovalController extends Controller
{
    public function index(Request $request)
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
    
        // Management melihat pengajuan berdasarkan departemen_dipilih
        $query = PengajuanTenagaKerja::with(['departemen', 'user'])
            ->where('departemen_dipilih', $managedDivisiId);
    
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
    
        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(10);
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

        $request->validate([
            'disetujui_oleh' => 'required|string|max:255',
            'jabatan_penyetuju' => 'required|string|max:255',
        ]);

        $pengajuan->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id(),
            'disetujui_oleh' => $request->disetujui_oleh,
            'jabatan_penyetuju' => $request->jabatan_penyetuju,
            'approved_at' => now(),
        ]);

        return redirect()->route('management.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disetujui!');
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

    public function printData(PengajuanTenagaKerja $pengajuan)
    {
        $managedDivisiId = Auth::user()->managed_divisi_id;
        
        if ($pengajuan->departemen_dipilih !== $managedDivisiId) {
            abort(403);
        }
        
        // Data untuk QR Code
        $qrData = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . "\n";
        $qrData .= "Posisi: " . $pengajuan->posisi . "\n";
        $qrData .= "Divisi: " . ($pengajuan->departemen->nama_divisi ?? '') . "\n";
        $qrData .= "Tanggal: " . $pengajuan->created_at->format('d/m/Y H:i') . "\n";
        $qrData .= "Pemohon: " . $pengajuan->nama_pemohon;
        
        // Generate QR Code
        $qrCode = QrCode::size(120)
            ->color(0,0,0)
            ->generate($qrData);
        
        return view('management.pengajuan.print', compact('pengajuan', 'qrCode'));
    }
}