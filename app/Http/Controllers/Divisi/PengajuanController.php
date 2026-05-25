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
            'diajukan_oleh' => 'required|string|max:255', // Wajib diisi
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
        if ($validated['jenis'] == 'penggantian' && $request->menggantikan) {
            $persyaratan[] = "Menggantikan karyawan: " . $request->menggantikan;
        }
    
        $tugas = array_filter($request->tugas ?? []);

        $pengajuanData = [
            'divisi_id' => Auth::user()->divisi_id,
            'user_id' => Auth::id(),
            'diajukan_oleh' => $validated['diajukan_oleh'],
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
}