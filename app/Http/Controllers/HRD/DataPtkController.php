<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DataPtkController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanTenagaKerja::with(['departemen', 'user'])
            ->orderBy('created_at', 'desc');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('divisi') && $request->divisi != '') {
            $query->where('departemen_dipilih', $request->divisi);
        }
        
        $ptkList = $query->paginate(15);
        $divisis = Divisi::all();
        
        return view('hrd.ptk.index', compact('ptkList', 'divisis'));
    }
    
    public function show(PengajuanTenagaKerja $ptk)
    {
        return view('hrd.ptk.show', compact('ptk'));
    }
    
    public function printData(PengajuanTenagaKerja $ptk)
    {
        // Gunakan view yang sama dengan management print
        $pengajuan = $ptk;
        
        // QR CODE UNTUK PEMOHON
        $qrDataPemohon = "=== DATA PEMOHON ===\n";
        $qrDataPemohon .= "No. PTK: PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . "\n";
        $qrDataPemohon .= "Posisi: " . $pengajuan->posisi . "\n";
        $qrDataPemohon .= "Divisi: " . ($pengajuan->departemen->nama_divisi ?? '') . "\n";
        $qrDataPemohon .= "Tanggal Pengajuan: " . $pengajuan->created_at->format('d/m/Y H:i') . "\n";
        $qrDataPemohon .= "Pemohon: " . $pengajuan->nama_pemohon;
        
        $qrCodePemohon = QrCode::size(60)
            ->color(0, 0, 0)
            ->generate($qrDataPemohon);
        
        // QR CODE UNTUK MANAGER (hanya jika sudah disetujui)
        $qrCodeManager = null;
        if ($pengajuan->status == 'disetujui') {
            $qrDataManager = "=== DATA PERSETUJUAN ===\n";
            $qrDataManager .= "No. PTK: PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . "\n";
            $qrDataManager .= "Disetujui Oleh: " . ($pengajuan->disetujui_oleh ?? 'Belum disetujui') . "\n";
            $qrDataManager .= "Jabatan: " . ($pengajuan->jabatan_penyetuju ?? '-') . "\n";
            $qrDataManager .= "Waktu Approve: " . ($pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y H:i:s') : '-') . "\n";
            $qrDataManager .= "Posisi: " . $pengajuan->posisi . "\n";
            $qrDataManager .= "Divisi: " . ($pengajuan->departemen->nama_divisi ?? '');
            
            $qrCodeManager = QrCode::size(60)
                ->color(0, 0, 0)
                ->generate($qrDataManager);
        }
        
        return view('management.pengajuan.print', compact('pengajuan', 'qrCodePemohon', 'qrCodeManager'));
    }
}