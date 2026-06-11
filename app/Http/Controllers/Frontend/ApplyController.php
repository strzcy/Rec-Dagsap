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
            
                return redirect()->route('frontend.apply.success', ['pelamar' => $pelamar->id])
                    ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan lengkapi data diri Anda.');
            } else {
                // Hapus data pelamar yang tidak lolos
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
    
    // HANYA SATU METHOD SUCCESS - TIDAK BOLEH DUPLIKAT
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
        if ($pelamar->status !== 'lolos_tahap1') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses.');
        }
    
        // Validasi data
        $validated = $request->validate([
            // A. DATA PRIBADI
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tinggi_badan' => 'nullable|numeric|min:0|max:250',
            'berat_badan' => 'nullable|numeric|min:0|max:300',
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
        
            // E. KEKUATAN & KELEMAHAN
            'kekuatan' => 'nullable|string',
            'kelemahan' => 'nullable|string',
        
            // J. REMUNERASI
            'gaji_diharapkan' => 'nullable|string',
        
            // K. WAKTU
            'waktu_bergabung' => 'nullable|string',
        
            // L. PERNYATAAN
            'tempat_pernyataan' => 'nullable|string',
            'tanggal_pernyataan' => 'nullable|date',
            'pernyataan_setuju' => 'required|accepted',
        
            // I. DATA KELUARGA (checkbox flags)
            'punya_pasangan' => 'nullable',
            'punya_anak' => 'nullable',
            'punya_saudara_di_perusahaan' => 'nullable',
        
            // H. RIWAYAT KESEHATAN
            'pernah_sakit_berat' => 'nullable',
            'sakit_berat_keterangan' => 'nullable|string',
            'punya_penyakit_keturunan' => 'nullable',
            'penyakit_keturunan_keterangan' => 'nullable|string',
            'pakai_kacamata' => 'nullable',
            'ukuran_kacamata' => 'nullable|string',
            'punya_alergi' => 'nullable',
            'alergi_keterangan' => 'nullable|string',
        ]);
    
        // Kumpulkan data dari array dinamis
        $pendidikanFormal = [];
        if ($request->has('pendidikan_tingkat')) {
            for ($i = 0; $i < count($request->pendidikan_tingkat); $i++) {
                if (!empty($request->pendidikan_tingkat[$i])) {
                    $pendidikanFormal[] = [
                        'tingkat' => $request->pendidikan_tingkat[$i],
                        'nama_sekolah' => $request->pendidikan_nama[$i] ?? '',
                        'kota' => $request->pendidikan_kota[$i] ?? '',
                        'jurusan' => $request->pendidikan_jurusan[$i] ?? '',
                        'tahun_masuk' => $request->pendidikan_tahun_masuk[$i] ?? '',
                        'tahun_lulus' => $request->pendidikan_tahun_lulus[$i] ?? '',
                        'ipk' => $request->pendidikan_ipk[$i] ?? '',
                        'keterangan' => $request->pendidikan_keterangan[$i] ?? '',
                    ];
                }
            }
        }
    
        $pelatihan = [];
        if ($request->has('pelatihan_nama')) {
            for ($i = 0; $i < count($request->pelatihan_nama); $i++) {
                if (!empty($request->pelatihan_nama[$i])) {
                    $pelatihan[] = [
                        'nama' => $request->pelatihan_nama[$i],
                        'tgl_mulai' => $request->pelatihan_tgl_mulai[$i] ?? '',
                        'tgl_selesai' => $request->pelatihan_tgl_selesai[$i] ?? '',
                        'lembaga' => $request->pelatihan_lembaga[$i] ?? '',
                        'sertifikat' => $request->pelatihan_sertifikat[$i] ?? '',
                    ];
                }
            }
        }
    
        $keterampilan = [];
        if ($request->has('keterampilan_nama')) {
            for ($i = 0; $i < count($request->keterampilan_nama); $i++) {
                if (!empty($request->keterampilan_nama[$i])) {
                    // Cari nilai radio button untuk item ini
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
    
        $pengalamanKerja = [];
        if ($request->has('pekerjaan_perusahaan')) {
            for ($i = 0; $i < count($request->pekerjaan_perusahaan); $i++) {
                if (!empty($request->pekerjaan_perusahaan[$i])) {
                    $pengalamanKerja[] = [
                        'perusahaan' => $request->pekerjaan_perusahaan[$i],
                        'tgl_masuk' => $request->pekerjaan_tgl_masuk[$i] ?? '',
                        'tgl_keluar' => $request->pekerjaan_tgl_keluar[$i] ?? '',
                        'jabatan' => $request->pekerjaan_jabatan[$i] ?? '',
                        'gaji' => $request->pekerjaan_gaji[$i] ?? '',
                        'alasan_keluar' => $request->pekerjaan_alasan[$i] ?? '',
                    ];
                }
            }
        }
    
        $bidangMinat = $request->bidang_minat ?? [];
        if ($request->filled('bidang_minat_lain')) {
            $bidangMinat[] = $request->bidang_minat_lain;
        }
    
        $referensi = [];
        if ($request->has('referensi_nama')) {
            for ($i = 0; $i < count($request->referensi_nama); $i++) {
                if (!empty($request->referensi_nama[$i])) {
                    $referensi[] = [
                        'nama' => $request->referensi_nama[$i],
                        'alamat' => $request->referensi_alamat[$i] ?? '',
                        'telp' => $request->referensi_telp[$i] ?? '',
                        'hubungan' => $request->referensi_hubungan[$i] ?? '',
                        'lama_kenal' => $request->referensi_lama_kenal[$i] ?? '',
                    ];
                }
            }
        }
    
        $saudaraPerusahaan = [];
        if ($request->has('saudara_nama')) {
            for ($i = 0; $i < count($request->saudara_nama); $i++) {
                if (!empty($request->saudara_nama[$i])) {
                    $saudaraPerusahaan[] = [
                        'nama' => $request->saudara_nama[$i],
                        'jabatan' => $request->saudara_jabatan[$i] ?? '',
                        'lama_kenal' => $request->saudara_lama_kenal[$i] ?? '',
                        'hubungan' => $request->saudara_hubungan[$i] ?? '',
                    ];
                }
            }
        }
    
        $dataPasangan = null;
        if ($request->punya_pasangan && $request->filled('nama_pasangan')) {
            $dataPasangan = [
                'nama_lengkap' => $request->nama_pasangan,
                'tempat_lahir' => $request->tempat_lahir_pasangan ?? '',
                'tanggal_lahir' => $request->tanggal_lahir_pasangan ?? '',
                'tanggal_menikah' => $request->tanggal_menikah ?? '',
                'agama' => $request->agama_pasangan ?? '',
                'alamat' => $request->alamat_pasangan ?? '',
                'pekerjaan' => $request->pekerjaan_pasangan ?? '',
                'jabatan' => $request->jabatan_pasangan ?? '',
            ];
        }
    
        $dataAnak = [];
        if ($request->has('anak_nama')) {
            for ($i = 0; $i < count($request->anak_nama); $i++) {
                if (!empty($request->anak_nama[$i])) {
                    $dataAnak[] = [
                        'nama' => $request->anak_nama[$i],
                        'jenis_kelamin' => $request->anak_jenis_kelamin[$i] ?? '',
                        'tempat_lahir' => $request->anak_tempat_lahir[$i] ?? '',
                        'tanggal_lahir' => $request->anak_tanggal_lahir[$i] ?? '',
                        'pendidikan' => $request->anak_pendidikan[$i] ?? '',
                    ];
                }
            }
        }
    
        $riwayatPenyakitKeluarga = [];
        if ($request->has('penyakit_nama')) {
            for ($i = 0; $i < count($request->penyakit_nama); $i++) {
                if (!empty($request->penyakit_nama[$i])) {
                    $riwayatPenyakitKeluarga[] = [
                        'nama' => $request->penyakit_nama[$i],
                        'jenis_penyakit' => $request->penyakit_jenis[$i] ?? '',
                        'hubungan' => $request->penyakit_hubungan[$i] ?? '',
                        'tahun_dirawat' => $request->penyakit_tahun[$i] ?? '',
                        'tempat' => $request->penyakit_tempat[$i] ?? '',
                    ];
                }
            }
        }
    
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
    
        $kontakDarurat = [
            'nama' => $request->kontak_darurat_nama,
            'hubungan' => $request->kontak_darurat_hubungan,
            'alamat' => $request->kontak_darurat_alamat,
            'no_telp' => $request->kontak_darurat_telp,
            'no_hp' => $request->kontak_darurat_hp,
            'pekerjaan' => $request->kontak_darurat_pekerjaan,
            'jabatan' => $request->kontak_darurat_jabatan,
        ];
    
        $saudaraKandung = [];
        if ($request->has('saudara_kandung_nama')) {
            for ($i = 0; $i < count($request->saudara_kandung_nama); $i++) {
                if (!empty($request->saudara_kandung_nama[$i])) {
                    $saudaraKandung[] = [
                        'nama' => $request->saudara_kandung_nama[$i],
                        'jenis_kelamin' => $request->saudara_kandung_jk[$i] ?? '',
                        'usia' => $request->saudara_kandung_usia[$i] ?? '',
                        'pendidikan' => $request->saudara_kandung_pendidikan[$i] ?? '',
                        'pekerjaan' => $request->saudara_kandung_pekerjaan[$i] ?? '',
                        'hubungan' => $request->saudara_kandung_hubungan[$i] ?? '',
                    ];
                }
            }
        }
    
        // Data untuk disimpan
        $detailData = [
            'pelamar_id' => $pelamar->id,
            // A
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'tinggi_badan' => $validated['tinggi_badan'] ?? null,
            'berat_badan' => $validated['berat_badan'] ?? null,
            'kewarganegaraan' => $validated['kewarganegaraan'] ?? 'Indonesia',
            'agama' => $validated['agama'],
            'golongan_darah' => $validated['golongan_darah'] ?? null,
            'alamat_tinggal' => $validated['alamat_tinggal'],
            'rt_rw_tinggal' => $validated['rt_rw_tinggal'] ?? null,
            'kelurahan_tinggal' => $validated['kelurahan_tinggal'] ?? null,
            'kecamatan_tinggal' => $validated['kecamatan_tinggal'] ?? null,
            'kabupaten_tinggal' => $validated['kabupaten_tinggal'] ?? null,
            'kota_tinggal' => $validated['kota_tinggal'] ?? null,
            'provinsi_tinggal' => $validated['provinsi_tinggal'] ?? null,
            'kode_pos_tinggal' => $validated['kode_pos_tinggal'] ?? null,
            'no_telp' => $validated['no_telp'] ?? null,
            'no_hp' => $validated['no_hp'],
            'no_wa' => $validated['no_wa'] ?? null,
            'alamat_ktp' => $validated['alamat_ktp'],
            'rt_rw_ktp' => $validated['rt_rw_ktp'] ?? null,
            'kelurahan_ktp' => $validated['kelurahan_ktp'] ?? null,
            'kecamatan_ktp' => $validated['kecamatan_ktp'] ?? null,
            'kabupaten_ktp' => $validated['kabupaten_ktp'] ?? null,
            'kota_ktp' => $validated['kota_ktp'] ?? null,
            'provinsi_ktp' => $validated['provinsi_ktp'] ?? null,
            'kode_pos_ktp' => $validated['kode_pos_ktp'] ?? null,
            'no_ktp' => $validated['no_ktp'],
            'no_npwp' => $validated['no_npwp'] ?? null,
            'no_bpjs_ketenagakerjaan' => $validated['no_bpjs_ketenagakerjaan'] ?? null,
            'status_perkawinan' => $validated['status_perkawinan'],
            'email' => $validated['email'],
            'hobby' => $validated['hobby'] ?? null,
            'organisasi' => $validated['organisasi'] ?? null,
        
            // B
            'pendidikan_formal' => $pendidikanFormal,
            'pelatihan' => $pelatihan,
        
            // C
            'keterampilan' => $keterampilan,
        
            // D
            'bahasa_asing' => $bahasaAsing,
        
            // E
            'kekuatan' => $validated['kekuatan'] ?? null,
            'kelemahan' => $validated['kelemahan'] ?? null,
        
            // F
            'pengalaman_kerja' => $pengalamanKerja,
            'bidang_minat' => $bidangMinat,
        
            // G
            'referensi' => $referensi,
            'punya_saudara_di_perusahaan' => $request->punya_saudara_di_perusahaan == '1',
            'saudara_di_perusahaan' => $saudaraPerusahaan,
        
            // H
            'pernah_sakit_berat' => $request->pernah_sakit_berat == '1',
            'sakit_berat_keterangan' => $validated['sakit_berat_keterangan'] ?? null,
            'punya_penyakit_keturunan' => $request->punya_penyakit_keturunan == '1',
            'penyakit_keturunan_keterangan' => $validated['penyakit_keturunan_keterangan'] ?? null,
            'pakai_kacamata' => $request->pakai_kacamata == '1',
            'ukuran_kacamata' => $validated['ukuran_kacamata'] ?? null,
            'punya_alergi' => $request->punya_alergi == '1',
            'alergi_keterangan' => $validated['alergi_keterangan'] ?? null,
        
            // I
            'punya_pasangan' => $request->punya_pasangan == '1',
            'data_pasangan' => $dataPasangan,
            'punya_anak' => $request->punya_anak == '1',
            'data_anak' => $dataAnak,
            'riwayat_penyakit_keluarga' => $riwayatPenyakitKeluarga,
            'data_orang_tua' => $dataOrangTua,
            'kontak_darurat' => $kontakDarurat,
            'saudara_kandung' => $saudaraKandung,
        
            // J
            'gaji_diharapkan' => $validated['gaji_diharapkan'] ?? null,
        
            // K
            'waktu_bergabung' => $validated['waktu_bergabung'] ?? null,
        
            // L
            'pernyataan_setuju' => $validated['pernyataan_setuju'] == '1',
            'tempat_pernyataan' => $validated['tempat_pernyataan'] ?? null,
            'tanggal_pernyataan' => $validated['tanggal_pernyataan'] ?? null,
        ];
    
        // Update data pelamar utama
         $pelamar->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_telepon' => $validated['no_hp'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat_tinggal'],
            'status' => 'psikotest' // <---- INI YANG PENTING: Ubah status jadi psikotest
        ]);
    
        // Simpan atau update detail
        \App\Models\DetailPelamar::updateOrCreate(
            ['pelamar_id' => $pelamar->id],
            $detailData
        );
    
        // Update status ke psikotest
    
        return redirect()->route('frontend.apply.success', $pelamar)
            ->with('success', 'Data diri berhasil disimpan! Silakan lanjutkan ke tahap psikotest.');
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
    
        // Urutan pendidikan dari rendah ke tinggi
        $tingkat_pendidikan = [
            'SD' => 1,
            'SMP' => 2, 
            'SMA/SMK' => 3,
            'D1' => 4,
            'D2' => 4,
            'D3' => 4,
            'S1' => 5,
            'S2' => 6,
            'S3' => 7
        ];
    
        // Pendidikan pelamar (default ke 0 jika tidak ditemukan)
        $pendidikan_pelamar = $tingkat_pendidikan[$pelamar->pendidikan_terakhir] ?? 0;
    
        // Pendidikan yang dibutuhkan (default ke SMA/SMK = 3)
        $pendidikan_dibutuhkan = $tingkat_pendidikan[$kriteria['pendidikan'] ?? 'SMA/SMK'] ?? 3;
    
        // LOGIKA: Pelamar lolos jika pendidikannya >= yang dibutuhkan
        // Contoh: S1 (5) >= S1 (5) → lolos
        // Contoh: S2 (6) >= S1 (5) → lolos (lebih tinggi)
        // Contoh: SMA (3) >= S1 (5) → TIDAK lolos
        if ($pendidikan_pelamar < $pendidikan_dibutuhkan) {
            \Log::info('Gagal pendidikan: ' . $pelamar->pendidikan_terakhir . ' vs ' . ($kriteria['pendidikan'] ?? 'SMA/SMK'));
            return false;
        }
    
        // Cek jurusan (jika ada dan tidak kosong)
        if (!empty($kriteria['jurusan']) && trim($kriteria['jurusan']) !== '') {
            $jurusan_pelamar = strtolower($pelamar->jurusan);
            $jurusan_dibutuhkan = strtolower($kriteria['jurusan']);
        
            // Cek apakah jurusan pelamar mengandung kata kunci yang dibutuhkan
            if (!str_contains($jurusan_pelamar, $jurusan_dibutuhkan)) {
                \Log::info('Gagal jurusan: ' . $pelamar->jurusan . ' tidak mengandung ' . $kriteria['jurusan']);
                // Jurusan tidak match, tapi tidak langsung gagal jika tidak wajib
                // Bisa dikomentari dulu jika ingin lebih longgar
                // return false;
            }
        }
    
        // Cek IPK (jika ada)
        if (!empty($kriteria['ipk']) && is_numeric($kriteria['ipk'])) {
            $ipk_pelamar = $pelamar->formulirJawaban()->where('field_name', 'ipk')->first();
            if ($ipk_pelamar && is_numeric($ipk_pelamar->jawaban)) {
                if (floatval($ipk_pelamar->jawaban) < floatval($kriteria['ipk'])) {
                    \Log::info('Gagal IPK: ' . $ipk_pelamar->jawaban . ' < ' . $kriteria['ipk']);
                    // return false;
                }
            }
        }
    
        // Cek pengalaman kerja (jika ada)
        if (!empty($kriteria['pengalaman']) && is_numeric($kriteria['pengalaman']) && $kriteria['pengalaman'] > 0) {
            // Parsing pengalaman kerja dari teks (sederhana)
            $pengalaman_text = strtolower($pelamar->pengalaman_kerja ?? '');
            $tahun_dibutuhkan = intval($kriteria['pengalaman']);
        
            // Cari angka tahun dalam teks pengalaman
            preg_match_all('/(\d+)\s*tahun/', $pengalaman_text, $matches);
            $pengalaman_pelamar = !empty($matches[1]) ? max($matches[1]) : 0;
        
            if ($pengalaman_pelamar < $tahun_dibutuhkan) {
                \Log::info('Gagal pengalaman: ' . $pengalaman_pelamar . ' < ' . $tahun_dibutuhkan);
                // Tidak langsung gagal, pengalaman bisa diabaikan jika tidak wajib
                // return false;
            }
        }
    
        // SEMUA CEK LULUS
        return true;
    }
    // public function psikotest(Pelamar $pelamar)
    // {
    //     if ($pelamar->status !== 'lolos_tahap1') {
    //         return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    //     }
    
    //     return view('frontend.apply.psikotest', compact('pelamar'));
    // }

    public function submitPsikotest(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'selesai' => 'required|accepted',
        ]);
    
        $pelamar->update([
            'status' => 'lolos_psikotest',
            'psikotest_selesai_at' => now(),
        ]);
    
        return redirect()->route('frontend.apply.success', $pelamar)
            ->with('success', 'Terima kasih telah mengikuti psikotest. HRD akan menghubungi Anda untuk jadwal interview.');
    }
    public function failed()
    {
        return view('frontend.apply.failed');
    }   
}