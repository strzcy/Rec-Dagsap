<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\DetailPelamar;
use App\Models\FormulirJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplyController extends Controller
{
    // Tidak perlu middleware auth karena frontend public
    
    public function index(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect('/')->with('error', 'Lowongan sudah ditutup!');
        }
        
        return view('frontend.apply.form', compact('lowongan'));
    }

    public function store(Request $request, Lowongan $lowongan)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'tahun_lulus' => 'required|integer|min:1950|max:' . date('Y'),
            'ipk' => 'nullable|string|max:10',
            'pengalaman_kerja' => 'nullable|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        
        try {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $ijazahPath = $request->file('ijazah')->store('ijazahs', 'public');
            
            $pelamar = Pelamar::create([
                'lowongan_id' => $lowongan->id,
                'nama_lengkap' => $validated['nama_lengkap'],
                'email' => $validated['email'],
                'no_telepon' => $validated['no_telepon'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
                'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
                'jurusan' => $validated['jurusan'],
                'tahun_lulus' => $validated['tahun_lulus'],
                'pengalaman_kerja' => $validated['pengalaman_kerja'] ?? null,
                'cv_path' => $cvPath,
                'ijazah_path' => $ijazahPath,
                'status' => 'pending',
            ]);
            
            if ($request->filled('ipk')) {
                FormulirJawaban::create([
                    'pelamar_id' => $pelamar->id,
                    'field_name' => 'ipk',
                    'jawaban' => $request->ipk
                ]);
            }
            
            $lolos = $this->checkKelulusan($pelamar, $lowongan);
            
            if ($lolos) {
                $pelamar->update(['status' => 'lolos_tahap1']);
                
                return redirect()->route('frontend.apply.success', $pelamar)
                    ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan lengkapi data diri Anda.');
            } else {
                $pelamar->update([
                    'status' => 'ditolak',
                    'catatan' => 'Tidak memenuhi kriteria yang ditentukan'
                ]);
                
                return redirect()->route('frontend.apply.success', $pelamar)
                    ->with('error', 'Maaf, Anda belum memenuhi kriteria yang ditentukan.');
            }
            
        } catch (\Exception $e) {
            Log::error('Error saat apply: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.');
        }
    }
    
    public function success(Pelamar $pelamar)
    {
        $hasDetail = DetailPelamar::where('pelamar_id', $pelamar->id)->exists();
        
        return view('frontend.apply.success', compact('pelamar', 'hasDetail'));
    }
    
    public function detailForm(Pelamar $pelamar)
    {
        if ($pelamar->status !== 'lolos_tahap1') {
            return redirect('/')->with('error', 'Anda belum memenuhi syarat untuk mengisi formulir ini.');
        }
    
        if (DetailPelamar::where('pelamar_id', $pelamar->id)->exists()) {
            return redirect()->route('frontend.apply.success', $pelamar)
                ->with('info', 'Anda sudah mengisi data diri sebelumnya.');
        }
    
        return view('frontend.apply.wizard', compact('pelamar'));
    }
    
    public function storeDetail(Request $request, Pelamar $pelamar)
    {
        // Cek apakah pelamar lolos tahap 1
        if ($pelamar->status !== 'lolos_tahap1') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses.');
        }
        
        $detailData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tinggi_badan' => 'nullable|string',
            'berat_badan' => 'nullable|string',
            'kewarganegaraan' => 'nullable|string',
            'agama' => 'required|string',
            'golongan_darah' => 'nullable|string',
            'alamat_tinggal' => 'required|string',
            'rt_rw_tinggal' => 'nullable|string',
            'kelurahan_tinggal' => 'nullable|string',
            'kecamatan_tinggal' => 'nullable|string',
            'kabupaten_tinggal' => 'nullable|string',
            'kota_tinggal' => 'nullable|string',
            'provinsi_tinggal' => 'nullable|string',
            'kode_pos_tinggal' => 'nullable|string',
            'no_telp' => 'nullable|string',
            'no_hp' => 'required|string',
            'no_wa' => 'nullable|string',
            'alamat_ktp' => 'required|string',
            'rt_rw_ktp' => 'nullable|string',
            'kelurahan_ktp' => 'nullable|string',
            'kecamatan_ktp' => 'nullable|string',
            'kabupaten_ktp' => 'nullable|string',
            'kota_ktp' => 'nullable|string',
            'provinsi_ktp' => 'nullable|string',
            'kode_pos_ktp' => 'nullable|string',
            'no_ktp' => 'required|string',
            'no_npwp' => 'nullable|string',
            'no_bpjs_ketenagakerjaan' => 'nullable|string',
            'status_perkawinan' => 'required|string',
            'email' => 'required|email',
            'hobby' => 'nullable|string',
            'organisasi' => 'nullable|string',
        ]);
        
        // Update data pelamar utama
        $pelamar->update([
            'nama_lengkap' => $detailData['nama_lengkap'],
            'no_telepon' => $detailData['no_hp'],
            'tempat_lahir' => $detailData['tempat_lahir'],
            'tanggal_lahir' => $detailData['tanggal_lahir'],
            'alamat' => $detailData['alamat_tinggal'],
        ]);
        
        // Simpan detail
        DetailPelamar::updateOrCreate(
            ['pelamar_id' => $pelamar->id],
            $detailData
        );
        
        return redirect()->route('frontend.apply.success', $pelamar)
            ->with('success', 'Data diri berhasil disimpan! Terima kasih.');
    }
    
    public function detail(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect('/')->with('error', 'Lowongan sudah tidak tersedia.');
        }
        
        return view('frontend.detail', compact('lowongan'));
    }
    
    private function checkKelulusan(Pelamar $pelamar, Lowongan $lowongan)
    {
        $pengajuan = $lowongan->pengajuan;
        $kriteria = is_array($pengajuan->kriteria) ? $pengajuan->kriteria : json_decode($pengajuan->kriteria, true);
        
        $tingkat_pendidikan = [
            'SD' => 1, 'SMP' => 2, 'SMA/SMK' => 3, 
            'D3' => 4, 'S1' => 5, 'S2' => 6
        ];
        
        $pendidikan_pelamar = $tingkat_pendidikan[$pelamar->pendidikan_terakhir] ?? 0;
        $pendidikan_required = $tingkat_pendidikan[$kriteria['pendidikan'] ?? 'SMA/SMK'] ?? 0;
        
        if ($pendidikan_pelamar < $pendidikan_required) {
            return false;
        }
        
        return true;
    }
}