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
        $divisis = \App\Models\Divisi::all();
        return view('divisi.pengajuan.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identitas Pemohon
            'nama_pemohon' => 'required|string|max:255',
            'nip_pemohon' => 'required|string|max:50',
            'jabatan_pemohon' => 'required|string|max:255',
            'no_hp_pemohon' => 'required|string|max:20',
            'departemen_dipilih' => 'required|exists:divisis,id',
        
            // Data PTK
            'jenis' => 'required|in:penambahan,penggantian',
            'posisi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_dibutuhkan' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) {
                    $minDate = now()->addDays(31);
                    if (strtotime($value) < strtotime($minDate)) {
                        $fail("Tanggal dibutuhkan harus minimal 31 hari dari sekarang (minimal " . $minDate->format('d/m/Y') . ")");
                    }
                },
            ],
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
    
        $persyaratan = array_filter($request->persyaratan ?? []);
        if ($validated['jenis'] == 'penggantian' && $request->menggantikan) {
            $persyaratan[] = "Menggantikan karyawan: " . $request->menggantikan;
        }
    
        $tugas = array_filter($request->tugas ?? []);

        $pengajuanData = [
            // Identitas Pemohon
            'nama_pemohon' => $validated['nama_pemohon'],
            'nip_pemohon' => $validated['nip_pemohon'],
            'jabatan_pemohon' => $validated['jabatan_pemohon'],
            'no_hp_pemohon' => $validated['no_hp_pemohon'],
            'departemen_dipilih' => $validated['departemen_dipilih'],
            'divisi_id' => $validated['departemen_dipilih'], // untuk kompatibilitas
            'user_id' => Auth::id(),
            'diajukan_oleh' => $validated['nama_pemohon'], // auto isi dari nama_pemohon
        
            // Data PTK
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
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }
        
        return view('divisi.pengajuan.show', compact('pengajuan'));
    }
}