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
        $qrDataPemohon = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . " - " .
        $pengajuan->posisi . " | " .
        $pengajuan->nama_pemohon . " " .    
        $pengajuan->created_at->format('d/m/Y H:i');
        
        $qrCodePemohon = QrCode::errorCorrection('L')
            ->size(70)
            ->color(0, 0, 0)
            ->generate($qrDataPemohon);
        
        // QR CODE UNTUK MANAGER (hanya jika sudah disetujui)
        $qrCodeManager = null;
        if ($pengajuan->status == 'disetujui') {
            $qrDataManager = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . " - " .
            $pengajuan->posisi . "  |  " .
            ($pengajuan->disetujui_oleh ?? 'Belum disetujui') . " | " .
            ($pengajuan->jabatan_penyetuju ?? '-') . " | " .
            ($pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y H:i') : '-') ;
            
            $qrCodeManager = QrCode::errorCorrection('L')
                ->size(70)
                ->color(0, 0, 0)
                ->generate($qrDataManager);
        }
        
        return view('management.pengajuan.print', compact('pengajuan', 'qrCodePemohon', 'qrCodeManager'));
    }
}