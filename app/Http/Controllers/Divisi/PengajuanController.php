<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanTenagaKerja;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

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
            'divisi_id' => $validated['departemen_dipilih'],
            'user_id' => Auth::id(),
            'diajukan_oleh' => $validated['nama_pemohon'],
        
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

        // HAPUS SESSION VERIFIED NIK AGAR USER HARUS VERIFIKASI ULANG
        session()->forget('verified_nik');
    
        $divisiNama = \App\Models\Divisi::find($validated['departemen_dipilih'])->nama_divisi;
    
        // Redirect ke DASHBOARD (bukan ke create atau index)
        return redirect()->route('divisi.dashboard')
            ->with('success_submit', true)
            ->with('success_message', 'Pengajuan tenaga kerja berhasil dikirim!')
            ->with('ptk_data', [
                'posisi' => $validated['posisi'],
                'divisi' => $divisiNama,
                'jumlah' => $validated['jumlah'],
                'tanggal_dibutuhkan' => \Carbon\Carbon::parse($validated['tanggal_dibutuhkan'])->format('d/m/Y')
            ]);
    }

    public function show(PengajuanTenagaKerja $pengajuan)
    {
        // Cek sesuai NIK
        $nik = session('verified_nik');
        if ($pengajuan->nip_pemohon != $nik) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }
        
        return view('divisi.pengajuan.show', compact('pengajuan'));
    }
    
    public function verifyForm()
    {
        // Hapus session lama
        session()->forget('verified_nik');
        return view('divisi.pengajuan.verify_nik');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'nik' => 'required|string'
        ]);
        
        $nik = $request->nik;
        
        // Cek apakah ada pengajuan dengan NIK tersebut
        $exists = PengajuanTenagaKerja::where('nip_pemohon', $nik)->exists();
        
        if (!$exists) {
            return back()->with('error', 'NIK/NIP tidak ditemukan. Pastikan Anda menggunakan NIK yang sama saat mengajukan PTK.');
        }
        
        // Simpan NIK ke session
        session(['verified_nik' => $nik]);
        
        return redirect()->route('divisi.pengajuan.index');
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
        $qrCode = QrCode::size(60)
            ->color(0, 0, 0)
            ->generate($qrData);
        
        return view('management.pengajuan.print', compact('pengajuan', 'qrCode'));
    }
}