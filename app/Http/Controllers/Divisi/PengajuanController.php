<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Divisi\StorePengajuanRequest;
use App\Http\Requests\Divisi\VerifyNikRequest;

class PengajuanController extends Controller
{
    // HANYA SATU METHOD INDEX - TIDAK BOLEH DUPLIKAT
    public function index()
    {
        $nik = session('verified_nik');
        
        if (!$nik) {
            return redirect()->route('divisi.pengajuan.verify');
        }
        
        $pengajuans = PengajuanTenagaKerja::where('nip_pemohon', $nik)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('divisi.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('divisi.pengajuan.create', compact('divisis'));
    }

    public function store(StorePengajuanRequest $request)
    {
        $validated = $request->validated();

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

        // Upload lampiran (sudah divalidasi di FormRequest)
        $lampiranPath = null;
        $lampiranNama = null;
        $lampiranJenis = null;

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $lampiranNama = $file->getClientOriginalName();
            $lampiranJenis = $file->getClientOriginalExtension();
            $lampiranPath = $file->store('lampiran_ptk', 'public');
        }

        $pengajuanData = [
            // Identitas Pemohon
            'nama_pemohon' => $validated['nama_pemohon'],
            'nip_pemohon' => $validated['nip_pemohon'],
            'jabatan_pemohon' => $validated['jabatan_pemohon'],
            'no_hp_pemohon' => $validated['no_hp_pemohon'],
            'departemen_dipilih' => $validated['departemen_dipilih'],
            'divisi_id' => $validated['departemen_dipilih'],
            'user_id' => Auth::id(),
            'diajukan_oleh' => $validated['nama_pemohon'],
    
            // Data PTK
            'jenis' => $validated['jenis'],
            'posisi' => $validated['posisi'],
            'jumlah' => $validated['jumlah'],
            'tanggal_dibutuhkan' => $validated['tanggal_dibutuhkan'],
            'kriteria' => $kriteria,
            'persyaratan' => array_values($persyaratan),
            'deskripsi_pekerjaan' => $validated['deskripsi_pekerjaan'],
            'tugas' => array_values($tugas),
            'status' => 'pending',
            'lampiran_path' => $lampiranPath,
            'lampiran_nama' => $lampiranNama,
            'lampiran_jenis' => $lampiranJenis,
        ];

        PengajuanTenagaKerja::create($pengajuanData);

        // HAPUS SESSION VERIFIED NIK AGAR USER HARUS VERIFIKASI ULANG
        session()->forget('verified_nik');

        $divisiNama = \App\Models\Divisi::find($validated['departemen_dipilih'])->nama_divisi;

        // Redirect ke DASHBOARD
        return redirect()->route('divisi.dashboard')
        ->with('success_submit', true)
        ->with('success_message', 'Pengajuan tenaga kerja berhasil dikirim!')
        ->with('ptk_data', [
            'posisi' => $validated['posisi'],
            'divisi' => $divisiNama,
            'jumlah' => $validated['jumlah'],
            'tanggal_dibutuhkan' => \Carbon\Carbon::parse($validated['tanggal_dibutuhkan'])->format('d/m/Y'),
            'waktu_pengajuan' => now()->format('d/m/Y H:i:s'), // TAMBAHKAN INI
        ]); 
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        Gate::authorize('view', $pengajuan);
        
        return view('divisi.pengajuan.show', compact('pengajuan'));
    }
    
    public function verifyForm()
    {
        // Hapus session lama
        session()->forget('verified_nik');
        return view('divisi.pengajuan.verify_nik');
    }

    public function verify(VerifyNikRequest $request)
    {
        $validated = $request->validated();
        
        $nik = $validated['nik'];
        
        // Cek apakah ada pengajuan dengan NIK tersebut
        $exists = PengajuanTenagaKerja::where('nip_pemohon', $nik)->exists();
        
        if (!$exists) {
            return back()->with('error', 'NIK/NIP tidak ditemukan. Pastikan Anda menggunakan NIK yang sama saat mengajukan PTK.');
        }
        
        // Simpan NIK ke session
        session(['verified_nik' => $nik]);
        
        return redirect()->route('divisi.pengajuan.index');
    }
}