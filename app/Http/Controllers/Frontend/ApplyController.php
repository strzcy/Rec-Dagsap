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
                
                return redirect()->route('frontend.apply.success', ['pelamar' => $pelamar->id])
                    ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan lengkapi data diri Anda.');
            } else {
                $pelamar->update([
                    'status' => 'ditolak',
                    'catatan' => 'Tidak memenuhi kriteria yang ditentukan'
                ]);
                
                return redirect()->route('frontend.apply.success', ['pelamar' => $pelamar->id])
                    ->with('error', 'Maaf, Anda belum memenuhi kriteria yang ditentukan.');
            }
            
        } catch (\Exception $e) {
            Log::error('Error saat apply: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.');
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
            'no_hp' => 'required|string',
            'alamat_ktp' => 'required|string',
            'no_ktp' => 'required|string',
            'status_perkawinan' => 'required|string',
            'email' => 'required|email',
            'pernyataan_setuju' => 'required|accepted',
        ]);
        
        // Data yang perlu di-encode ke JSON
        $detailData = [
            'pelamar_id' => $pelamar->id,
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
            'no_hp' => $validated['no_hp'],
            'alamat_ktp' => $validated['alamat_ktp'],
            'no_ktp' => $validated['no_ktp'],
            'status_perkawinan' => $validated['status_perkawinan'],
            'email' => $validated['email'],
            'pernyataan_setuju' => $validated['pernyataan_setuju'] == '1',
            'tempat_pernyataan' => $request->tempat_pernyataan ?? null,
            'tanggal_pernyataan' => $request->tanggal_pernyataan ?? null,
            'kekuatan' => $request->kekuatan ?? null,
            'kelemahan' => $request->kelemahan ?? null,
            'gaji_diharapkan' => $request->gaji_diharapkan ?? null,
            'waktu_bergabung' => $request->waktu_bergabung ?? null,
            'pernah_sakit_berat' => $request->pernah_sakit_berat == '1',
            'sakit_berat_keterangan' => $request->sakit_berat_keterangan ?? null,
            'punya_penyakit_keturunan' => $request->punya_penyakit_keturunan == '1',
            'penyakit_keturunan_keterangan' => $request->penyakit_keturunan_keterangan ?? null,
            'pakai_kacamata' => $request->pakai_kacamata == '1',
            'ukuran_kacamata' => $request->ukuran_kacamata ?? null,
            'punya_alergi' => $request->punya_alergi == '1',
            'alergi_keterangan' => $request->alergi_keterangan ?? null,
            'punya_pasangan' => $request->punya_pasangan == '1',
            'punya_anak' => $request->punya_anak == '1',
            'punya_saudara_di_perusahaan' => $request->punya_saudara_di_perusahaan == '1',
        ];
        
        // Update data pelamar utama
        $pelamar->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_telepon' => $validated['no_hp'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat_tinggal'],
        ]);
        
        // Simpan detail
        DetailPelamar::updateOrCreate(
            ['pelamar_id' => $pelamar->id],
            $detailData
        );
        
        // Update status ke psikotest
        $pelamar->update(['status' => 'psikotest']);
        
        return redirect()->route('frontend.apply.success', $pelamar)
            ->with('success', 'Data diri berhasil disimpan! Terima kasih. Kami akan memproses lamaran Anda.');
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