<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanTenagaKerja::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('divisi.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        // Tidak perlu $pengajuans di sini karena ini form create
        return view('divisi.pengajuan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:penambahan,penggantian',
            'posisi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_dibutuhkan' => 'required|date',
            'deskripsi_pekerjaan' => 'required|string',
            'kriteria_pendidikan' => 'required|string',
            'kriteria_jurusan' => 'nullable|string',
            'kriteria_pengalaman' => 'nullable|string',
            'kriteria_ipk' => 'nullable|string',
            'kriteria_keahlian' => 'nullable|string',
            'tugas' => 'nullable|array',
            'persyaratan' => 'nullable|array',
            'menggantikan' => 'nullable|string',
        ]);

        // Build kriteria JSON
        $kriteria = [
            'pendidikan' => $validated['kriteria_pendidikan'],
            'jurusan' => $validated['kriteria_jurusan'] ?? '',
            'pengalaman' => $validated['kriteria_pengalaman'] ?? '0',
            'ipk' => $validated['kriteria_ipk'] ?? '',
            'keahlian' => $validated['kriteria_keahlian'] ?? '',
        ];
        
        // Build persyaratan JSON
        $persyaratan = $request->persyaratan ?? [];
        if ($validated['jenis'] == 'penggantian' && $request->menggantikan) {
            $persyaratan[] = "Menggantikan karyawan: " . $request->menggantikan;
        }
        
        // Filter persyaratan yang kosong
        $persyaratan = array_filter($persyaratan);
        
        // Build tugas JSON
        $tugas = $request->tugas ?? [];
        $tugas = array_filter($tugas);

        $pengajuanData = [
            'divisi_id' => Auth::user()->divisi_id,
            'user_id' => Auth::id(),
            'jenis' => $validated['jenis'],
            'posisi' => $validated['posisi'],
            'jumlah' => $validated['jumlah'],
            'tanggal_dibutuhkan' => $validated['tanggal_dibutuhkan'],
            'kriteria' => json_encode($kriteria),
            'persyaratan' => json_encode(array_values($persyaratan)),
            'deskripsi_pekerjaan' => $validated['deskripsi_pekerjaan'],
            'tugas' => json_encode(array_values($tugas)),
            'status' => 'pending',
        ];

        PengajuanTenagaKerja::create($pengajuanData);

        return redirect()->route('divisi.pengajuan.index')
            ->with('success', 'Pengajuan tenaga kerja berhasil dikirim!');
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        // Pastikan pengajuan milik user yang login
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }
        
        return view('divisi.pengajuan.show', compact('pengajuan'));
    }
    
    public function edit(PengajuanTenagaKerja $pengajuan)
    {
        // Hanya bisa edit jika status masih pending
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('divisi.pengajuan.index')
                ->with('error', 'Pengajuan sudah diproses, tidak dapat diedit.');
        }
        
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('divisi.pengajuan.edit', compact('pengajuan'));
    }
    
    public function update(Request $request, PengajuanTenagaKerja $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('divisi.pengajuan.index')
                ->with('error', 'Pengajuan sudah diproses, tidak dapat diupdate.');
        }
        
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'jenis' => 'required|in:penambahan,penggantian',
            'posisi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_dibutuhkan' => 'required|date',
            'deskripsi_pekerjaan' => 'required|string',
            'kriteria_pendidikan' => 'required|string',
            'kriteria_jurusan' => 'nullable|string',
            'kriteria_pengalaman' => 'nullable|string',
            'kriteria_ipk' => 'nullable|string',
            'kriteria_keahlian' => 'nullable|string',
            'tugas' => 'nullable|array',
            'persyaratan' => 'nullable|array',
        ]);

        // Build kriteria JSON
        $kriteria = [
            'pendidikan' => $validated['kriteria_pendidikan'],
            'jurusan' => $validated['kriteria_jurusan'] ?? '',
            'pengalaman' => $validated['kriteria_pengalaman'] ?? '0',
            'ipk' => $validated['kriteria_ipk'] ?? '',
            'keahlian' => $validated['kriteria_keahlian'] ?? '',
        ];
        
        $persyaratan = array_filter($request->persyaratan ?? []);
        $tugas = array_filter($request->tugas ?? []);

        $pengajuan->update([
            'jenis' => $validated['jenis'],
            'posisi' => $validated['posisi'],
            'jumlah' => $validated['jumlah'],
            'tanggal_dibutuhkan' => $validated['tanggal_dibutuhkan'],
            'kriteria' => json_encode($kriteria),
            'persyaratan' => json_encode(array_values($persyaratan)),
            'deskripsi_pekerjaan' => $validated['deskripsi_pekerjaan'],
            'tugas' => json_encode(array_values($tugas)),
        ]);

        return redirect()->route('divisi.pengajuan.index')
            ->with('success', 'Pengajuan berhasil diupdate!');
    }
    
    public function destroy(PengajuanTenagaKerja $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('divisi.pengajuan.index')
                ->with('error', 'Pengajuan sudah diproses, tidak dapat dihapus.');
        }
        
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        
        $pengajuan->delete();
        
        return redirect()->route('divisi.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus!');
    }
}