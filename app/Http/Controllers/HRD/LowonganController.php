<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan_tenaga_kerjas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

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
        if ($lowongan->hrd_id !== Auth::id()) {
            abort(403);
        }
        
        return view('hrd.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        if ($lowongan->hrd_id !== Auth::id()) {
            abort(403);
        }
        
        return view('hrd.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        if ($lowongan->hrd_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,publikasi,ditutup',
        ]);

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
        if ($lowongan->hrd_id !== Auth::id()) {
            abort(403);
        }

        if ($lowongan->banner_image) {
            Storage::disk('public')->delete($lowongan->banner_image);
        }

        $lowongan->delete();

        return redirect()->route('hrd.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }

    public function printData(Lowongan $lowongan)
    {
        if ($lowongan->hrd_id !== Auth::id()) {
            abort(403);
        }
        
        $pengajuan = $lowongan->pengajuan;
        
        // Data untuk QR Code (jadikan string biasa, bukan JSON biar lebih simple)
        $qrData = "PTK-" . str_pad($pengajuan->id, 6, '0', STR_PAD_LEFT) . "\n";
        $qrData .= "Posisi: " . $pengajuan->posisi . "\n";
        $qrData .= "Divisi: " . ($pengajuan->departemen->nama_divisi ?? '') . "\n";
        $qrData .= "Tanggal: " . $pengajuan->created_at->format('d/m/Y H:i') . "\n";
        $qrData .= "Pemohon: " . $pengajuan->nama_pemohon;
        
        // Generate QR Code (langsung return string HTML)
        $qrCode = QrCode::size(120)
            ->color(0, 0, 0)
            ->generate($qrData);
        
        return view('management.pengajuan.print', compact('pengajuan', 'qrCode'));
    }

    
}