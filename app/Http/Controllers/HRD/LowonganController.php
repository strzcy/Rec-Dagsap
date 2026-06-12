<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HRD\StoreLowonganRequest;
use App\Http\Requests\HRD\UpdateLowonganRequest;
use Illuminate\Support\Facades\Gate;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 


class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::with(['pengajuan.divisi'])
            ->where('hrd_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('hrd.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        // Ambil pengajuan yang sudah disetujui dan belum dibuat lowongan
        // Perbaiki query: menggunakan pengajuan_id, bukan pengajuan_tenaga_kerja_id
        $pengajuans = PengajuanTenagaKerja::with('divisi')
            ->where('status', 'disetujui')
            ->whereDoesntHave('lowongan')
            ->get();
        
        return view('hrd.lowongan.create', compact('pengajuans'));
    }

    public function store(StoreLowonganRequest $request)
    {
        $validated = $request->validated();

        $validated['hrd_id'] = Auth::id();
        $validated['status'] = 'publikasi';

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $path;
        }

        Lowongan::create($validated);

        return redirect()->route('hrd.lowongan.index')
            ->with('success', 'Lowongan berhasil dipublikasikan!');
    }

    public function show(Lowongan $lowongan)
    {
        Gate::authorize('view', $lowongan);
        
        return view('hrd.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        Gate::authorize('update', $lowongan);
        
        return view('hrd.lowongan.edit', compact('lowongan'));
    }

    public function update(UpdateLowonganRequest $request, Lowongan $lowongan)
    {
        Gate::authorize('update', $lowongan);

        $validated = $request->validated();

        if ($request->hasFile('banner_image')) {
            if ($lowongan->banner_image) {
                Storage::disk('public')->delete($lowongan->banner_image);
            }
            $path = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $path;
        }

        $lowongan->update($validated);

        return redirect()->route('hrd.lowongan.index')
            ->with('success', 'Lowongan berhasil diupdate!');
    }

    public function destroy(Lowongan $lowongan)
    {
        Gate::authorize('delete', $lowongan);

        if ($lowongan->banner_image) {
            Storage::disk('public')->delete($lowongan->banner_image);
        }

        $lowongan->delete();

        return redirect()->route('hrd.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }

    public function printData(Lowongan $lowongan)
    {
        Gate::authorize('print', $lowongan);

        $pengajuan = $lowongan->pengajuan;

        // QR CODE UNTUK MANAGER (Diketahui Oleh / Atasan)
        $qrDataManager = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . " | " .
            ($pengajuan->disetujui_oleh ?? 'Belum disetujui') . " | " .
            ($pengajuan->jabatan_penyetuju ?? '-') . " | " .
            ($pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y') : '-') . " | " .
            $pengajuan->posisi;

        $qrCodeManager = QrCode::errorCorrection('L')
            ->size(70)
            ->color(0, 0, 0)
            ->generate($qrDataManager);

        // QR CODE UNTUK PEMOHON (Diajukan Oleh)
        $qrDataPemohon = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . " | " .
            $pengajuan->posisi . " | " .
            ($pengajuan->departemen->nama_divisi ?? '') . " | " .
            $pengajuan->created_at->format('d/m/Y') . " | " .
            $pengajuan->nama_pemohon;

        $qrCodePemohon = QrCode::errorCorrection('L')
            ->size(70)
            ->color(0, 0, 0)
            ->generate($qrDataPemohon);

        return view('management.pengajuan.print', compact('pengajuan', 'qrCodePemohon', 'qrCodeManager'));
    }

    
}