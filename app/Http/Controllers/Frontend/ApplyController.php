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
use Illuminate\Support\Facades\URL;

class ApplyController extends Controller
{
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
            'tanggal_lahir' => 'required|date|before_or_equal:today',
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
            
                return redirect()->to(URL::signedRoute('frontend.apply.success', ['pelamar' => $pelamar->id]))
                    ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan lengkapi data diri Anda.');
            } else {
                \Storage::disk('public')->delete($cvPath);
                \Storage::disk('public')->delete($ijazahPath);
            
                if ($pelamar->formulirJawaban) {
                    $pelamar->formulirJawaban()->delete();
                }
            
                $pelamarNama = $pelamar->nama_lengkap;
                $pelamar->forceDelete();
            
                return redirect()->route('frontend.apply.failed')
                    ->with('error', 'Maaf, ' . $pelamarNama . '! Anda belum memenuhi kriteria yang ditentukan.')
                    ->with('reason', 'Berdasarkan kriteria yang dibutuhkan, pendidikan atau kualifikasi Anda belum sesuai dengan persyaratan lowongan ini.');
            }
        
        } catch (\Exception $e) {
            Log::error('Error saat apply: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.');
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
            return redirect()->to(URL::signedRoute('frontend.apply.success', ['pelamar' => $pelamar->id]))
                ->with('info', 'Anda sudah mengisi data diri sebelumnya.');
        }
        
        return view('frontend.apply.wizard', compact('pelamar'));
    }
    
    public function detail(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect('/')->with('error', 'Lowongan sudah tidak tersedia.');
        }
        
        return view('frontend.detail', compact('lowongan'));
    }
    
    public function submitPsikotest(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'selesai' => 'required|accepted',
        ]);
    
        $pelamar->update([
            'status' => 'lolos_psikotest',
            'psikotest_selesai_at' => now(),
        ]);
    
        return redirect()->to(URL::signedRoute('frontend.apply.success', ['pelamar' => $pelamar->id]))
            ->with('success', 'Terima kasih telah mengikuti psikotest. HRD akan menghubungi Anda untuk jadwal interview.');
    }
    
    public function failed()
    {
        return view('frontend.apply.failed');
    }
    
    public function storeDetail(Request $request, Pelamar $pelamar)
    {
        if ($pelamar->status !== 'lolos_tahap1') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses.');
        }

        // VALIDASI DATA
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'tinggi_badan' => 'required|numeric|min:50|max:300',
            'berat_badan' => 'required|numeric|min:10|max:500',
            'kewarganegaraan' => 'required|string',
            'agama' => 'required|string',
            'golongan_darah' => 'required|string',
            'alamat_tinggal' => 'required|string',
            'rt_rw_tinggal' => 'required|string',
            'kelurahan_tinggal' => 'required|string',
            'kecamatan_tinggal' => 'required|string',
            'kabupaten_tinggal' => 'required|string',
            'kota_tinggal' => 'required|string',
            'provinsi_tinggal' => 'required|string',
            'kode_pos_tinggal' => 'required|string',
            'no_hp' => 'required|string|min:10|max:15',
            'alamat_ktp' => 'required|string',
            'rt_rw_ktp' => 'required|string',
            'kelurahan_ktp' => 'required|string',
            'kecamatan_ktp' => 'required|string',
            'kabupaten_ktp' => 'required|string',
            'kota_ktp' => 'required|string',
            'provinsi_ktp' => 'required|string',
            'kode_pos_ktp' => 'required|string',
            'no_ktp' => 'required|string|min:16|max:16',
            'status_perkawinan' => 'required|string',
            'email' => 'required|email',
            'hobby' => 'nullable|string',
            'organisasi' => 'nullable|string',
            'pernyataan_setuju' => 'required|accepted',
            
            'nama_ayah' => 'required|string|max:255',
            'agama_ayah' => 'required|string|max:50',
            'usia_ayah' => 'required|string|max:10',
            'pekerjaan_ayah' => 'required|string|max:255',
            'alamat_ayah' => 'required|string',
            'nama_ibu' => 'required|string|max:255',
            'agama_ibu' => 'required|string|max:50',
            'usia_ibu' => 'required|string|max:10',
            'pekerjaan_ibu' => 'required|string|max:255',
            'alamat_ibu' => 'required|string',
            
            'gaji_diharapkan' => 'required|string',
            'waktu_bergabung' => 'required|string',
            'tempat_pernyataan' => 'nullable|string',
            
            'kekuatan' => 'required|string|min:10',
            'kelemahan' => 'required|string|min:10',
        ]);

        // Kumpulkan data dinamis - PENDIDIKAN
        $pendidikanFormal = [];
        if ($request->has('pendidikan_tingkat')) {
            for ($i = 0; $i < count($request->pendidikan_tingkat); $i++) {
                if (!empty($request->pendidikan_tingkat[$i])) {
                    $pendidikanFormal[] = [
                        'tingkat' => $request->pendidikan_tingkat[$i],
                        'nama_sekolah' => $request->pendidikan_nama[$i] ?? '',
                        'kota' => $request->pendidikan_kota[$i] ?? '',
                        'jurusan' => $request->pendidikan_jurusan[$i] ?? '',
                        'tahun_lulus' => $request->pendidikan_tahun_lulus[$i] ?? '',
                        'ipk' => $request->pendidikan_ipk[$i] ?? '',
                    ];
                }
            }
        }

        // KETERAMPILAN
        $keterampilan = [];
        if ($request->has('keterampilan_nama')) {
            for ($i = 0; $i < count($request->keterampilan_nama); $i++) {
                if (!empty($request->keterampilan_nama[$i])) {
                    $tingkat = 'Cukup Mahir';
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, 'keterampilan_tingkat_') === 0 && $value) {
                            $tingkat = $value;
                            break;
                        }
                    }
                    $keterampilan[] = [
                        'nama' => $request->keterampilan_nama[$i],
                        'tingkat' => $tingkat,
                    ];
                }
            }
        }

        // BAHASA ASING
        $bahasaAsing = [];
        if ($request->has('bahasa_nama')) {
            for ($i = 0; $i < count($request->bahasa_nama); $i++) {
                if (!empty($request->bahasa_nama[$i])) {
                    $bahasaAsing[] = [
                        'nama' => $request->bahasa_nama[$i],
                        'membaca' => $request->bahasa_membaca[$i] ?? 'Cukup',
                        'berbicara' => $request->bahasa_berbicara[$i] ?? 'Cukup',
                        'menulis' => $request->bahasa_menulis[$i] ?? 'Cukup',
                    ];
                }
            }
        }

        // REFERENSI
        $referensi = [];
        if ($request->has('referensi_nama')) {
            for ($i = 0; $i < count($request->referensi_nama); $i++) {
                if (!empty($request->referensi_nama[$i])) {
                    $referensi[] = [
                        'nama' => $request->referensi_nama[$i],
                        'alamat' => $request->referensi_alamat[$i] ?? '',
                        'telp' => $request->referensi_telp[$i] ?? '',
                        'hubungan' => $request->referensi_hubungan[$i] ?? '',
                    ];
                }
            }
        }

        // DATA ORANG TUA
        $dataOrangTua = [
            'ayah_nama' => $request->nama_ayah,
            'ayah_agama' => $request->agama_ayah,
            'ayah_usia' => $request->usia_ayah,
            'ayah_pekerjaan' => $request->pekerjaan_ayah,
            'ayah_alamat' => $request->alamat_ayah,
            'ibu_nama' => $request->nama_ibu,
            'ibu_agama' => $request->agama_ibu,
            'ibu_usia' => $request->usia_ibu,
            'ibu_pekerjaan' => $request->pekerjaan_ibu,
            'ibu_alamat' => $request->alamat_ibu,
        ];

        // KONTAK DARURAT
        $kontakDarurat = [
            'nama' => $request->kontak_darurat_nama,
            'hubungan' => $request->kontak_darurat_hubungan,
            'alamat' => $request->kontak_darurat_alamat,
            'no_hp' => $request->kontak_darurat_hp,
            'pekerjaan' => $request->kontak_darurat_pekerjaan,
        ];

        // SAUDARA KANDUNG
        $saudaraKandung = [];
        if ($request->has('saudara_kandung_nama')) {
            for ($i = 0; $i < count($request->saudara_kandung_nama); $i++) {
                if (!empty($request->saudara_kandung_nama[$i])) {
                    $saudaraKandung[] = [
                        'nama' => $request->saudara_kandung_nama[$i],
                        'hubungan' => $request->saudara_kandung_hubungan[$i] ?? '',
                    ];
                }
            }
        }

        // DATA UNTUK DISIMPAN
        $detailData = [
            'pelamar_id' => $pelamar->id,
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'berat_badan' => $validated['berat_badan'],
            'kewarganegaraan' => $validated['kewarganegaraan'],
            'agama' => $validated['agama'],
            'golongan_darah' => $validated['golongan_darah'],
            'alamat_tinggal' => $validated['alamat_tinggal'],
            'rt_rw_tinggal' => $validated['rt_rw_tinggal'],
            'kelurahan_tinggal' => $validated['kelurahan_tinggal'],
            'kecamatan_tinggal' => $validated['kecamatan_tinggal'],
            'kabupaten_tinggal' => $validated['kabupaten_tinggal'],
            'kota_tinggal' => $validated['kota_tinggal'],
            'provinsi_tinggal' => $validated['provinsi_tinggal'],
            'kode_pos_tinggal' => $validated['kode_pos_tinggal'],
            'no_hp' => $validated['no_hp'],
            'alamat_ktp' => $validated['alamat_ktp'],
            'rt_rw_ktp' => $validated['rt_rw_ktp'],
            'kelurahan_ktp' => $validated['kelurahan_ktp'],
            'kecamatan_ktp' => $validated['kecamatan_ktp'],
            'kabupaten_ktp' => $validated['kabupaten_ktp'],
            'kota_ktp' => $validated['kota_ktp'],
            'provinsi_ktp' => $validated['provinsi_ktp'],
            'kode_pos_ktp' => $validated['kode_pos_ktp'],
            'no_ktp' => $validated['no_ktp'],
            'status_perkawinan' => $validated['status_perkawinan'],
            'email' => $validated['email'],
            'hobby' => $validated['hobby'],
            'organisasi' => $validated['organisasi'],
            'pendidikan_formal' => $pendidikanFormal,
            'keterampilan' => $keterampilan,
            'bahasa_asing' => $bahasaAsing,
            'kekuatan' => $validated['kekuatan'],
            'kelemahan' => $validated['kelemahan'],
            'referensi' => $referensi,
            'pernah_sakit_berat' => $request->pernah_sakit_berat == '1',
            'punya_penyakit_keturunan' => $request->punya_penyakit_keturunan == '1',
            'pakai_kacamata' => $request->pakai_kacamata == '1',
            'punya_alergi' => $request->punya_alergi == '1',
            'data_orang_tua' => $dataOrangTua,
            'kontak_darurat' => $kontakDarurat,
            'saudara_kandung' => $saudaraKandung,
            'gaji_diharapkan' => $validated['gaji_diharapkan'],
            'waktu_bergabung' => $validated['waktu_bergabung'],
            'pernyataan_setuju' => true,
            'tempat_pernyataan' => $validated['tempat_pernyataan'] ?? 'Jakarta',
            'tanggal_pernyataan' => now()->format('Y-m-d'),
        ];

        // Update data pelamar utama
        $pelamar->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_telepon' => $validated['no_hp'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat_tinggal'],
            'status' => 'psikotest'
        ]);

        // Simpan detail
        DetailPelamar::updateOrCreate(
            ['pelamar_id' => $pelamar->id],
            $detailData
        );

        return redirect()->to(URL::signedRoute('frontend.apply.success', ['pelamar' => $pelamar->id]))
            ->with('success', 'Data diri berhasil disimpan! Silakan lanjutkan ke tahap psikotest.');
    }
    
    private function checkKelulusan(Pelamar $pelamar, Lowongan $lowongan)
    {
        $pengajuan = $lowongan->pengajuan;
        $kriteria = $pengajuan->kriteria;
        if (is_string($kriteria)) {
            $kriteria = json_decode($kriteria, true) ?? [];
        }
        if (!is_array($kriteria)) {
            $kriteria = [];
        }
    
        $tingkat_pendidikan = [
            'SD' => 1, 'SMP' => 2, 'SMA/SMK' => 3,
            'D1' => 4, 'D2' => 4, 'D3' => 4,
            'S1' => 5, 'S2' => 6, 'S3' => 7
        ];
    
        $pendidikan_pelamar = $tingkat_pendidikan[$pelamar->pendidikan_terakhir] ?? 0;
        $pendidikan_dibutuhkan = $tingkat_pendidikan[$kriteria['pendidikan'] ?? 'SMA/SMK'] ?? 3;
    
        if ($pendidikan_pelamar < $pendidikan_dibutuhkan) {
            return false;
        }
    
        return true;
    }
}