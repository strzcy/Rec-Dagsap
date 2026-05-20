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
        $pengajuans = PengajuanTenagaKerja::where('divisi_id', Auth::user()->divisi_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('divisi.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
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
    
        // Build tugas JSON
        $tugas = $request->tugas ?? [];

        $pengajuanData = [
            'divisi_id' => Auth::user()->divisi_id,
            'user_id' => Auth::id(),
            'jenis' => $validated['jenis'],
            'posisi' => $validated['posisi'],
            'jumlah' => $validated['jumlah'],
            'kriteria' => $kriteria,
            'persyaratan' => $persyaratan,
            'deskripsi_pekerjaan' => $validated['deskripsi_pekerjaan'],
            'tugas' => $tugas,
            'status' => 'pending',
        ];

        PengajuanTenagaKerja::create($pengajuanData);

        return redirect()->route('divisi.pengajuan.index')
            ->with('success', 'Pengajuan tenaga kerja berhasil dikirim!');
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        // Pastikan pengajuan milik divisi user
        if ($pengajuan->divisi_id !== Auth::user()->divisi_id) {
            abort(403);
        }
        
        return view('divisi.pengajuan.show', compact('pengajuan'));
    }
}