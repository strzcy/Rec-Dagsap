<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\FormulirJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ApplyController extends Controller
{
    public function index(Lowongan $lowongan)
    {
        // Cek apakah lowongan masih aktif
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect('/')->with('error', 'Lowongan sudah ditutup!');
        }
        
        return view('frontend.apply.form', compact('lowongan'));
    }

    public function store(Request $request, Lowongan $lowongan)
    {
        // Validasi dasar
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
        
        // Upload files
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $ijazahPath = $request->file('ijazah')->store('ijazahs', 'public');
        
        // Simpan data pelamar
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
        
        // Simpan IPK jika ada
        if ($request->filled('ipk')) {
            FormulirJawaban::create([
                'pelamar_id' => $pelamar->id,
                'field_name' => 'ipk',
                'jawaban' => $request->ipk
            ]);
        }
        
        // Cek kelulusan berdasarkan kriteria
        $lolos = $this->checkKelulusan($pelamar, $lowongan);
        
        if ($lolos) {
            // Update status lolos tahap 1
            $pelamar->update([
                'status' => 'lolos_tahap1'
            ]);
            
            // Generate psikotest link (simulasi)
            $psikotestLink = url('/psikotest/' . encrypt($pelamar->id));
            $pelamar->update([
                'psikotest_link' => $psikotestLink,
                'psikotest_dikirim_at' => now()
            ]);
            
            // Kirim email lolos
            $this->sendEmailLolos($pelamar, $psikotestLink);
            
            return redirect()->route('frontend.apply.success', $pelamar)
                ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan cek email untuk mengikuti psikotest.');
        } else {
            // Update status ditolak
            $pelamar->update([
                'status' => 'ditolak',
                'catatan' => 'Tidak memenuhi kriteria yang ditentukan'
            ]);
            
            // Kirim email ditolak
            $this->sendEmailDitolak($pelamar);
            
            return redirect()->route('frontend.apply.success', $pelamar)
                ->with('error', 'Maaf, Anda belum memenuhi kriteria yang ditentukan. Silakan cek email untuk informasi lebih lanjut.');
        }
    }
    
    public function success(Pelamar $pelamar)
    {
        return view('frontend.apply.success', compact('pelamar'));
    }
    
    public function psikotest($token)
    {
        try {
            $pelamarId = decrypt($token);
            $pelamar = Pelamar::findOrFail($pelamarId);
            
            if ($pelamar->status !== 'lolos_tahap1') {
                return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            return view('frontend.apply.psikotest', compact('pelamar'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Link tidak valid.');
        }
    }
    
    public function submitPsikotest(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'jawaban_1' => 'required|string',
            'jawaban_2' => 'required|string',
            'jawaban_3' => 'required|string',
        ]);
        
        // Simpan jawaban psikotest
        FormulirJawaban::create([
            'pelamar_id' => $pelamar->id,
            'field_name' => 'psikotest_jawaban',
            'jawaban' => json_encode($request->only(['jawaban_1', 'jawaban_2', 'jawaban_3']))
        ]);
        
        // Update status
        $pelamar->update([
            'status' => 'lolos_psikotest',
            'psikotest_selesai_at' => now()
        ]);
        
        // Notifikasi ke HRD (bisa via email atau database notification)
        // Untuk sekarang, hanya update status
        
        return redirect()->route('frontend.apply.success', $pelamar)
            ->with('success', 'Terima kasih telah mengisi psikotest. HRD akan menghubungi Anda untuk jadwal interview.');
    }
    
    private function checkKelulusan(Pelamar $pelamar, Lowongan $lowongan)
    {
        $pengajuan = $lowongan->pengajuan;
        $kriteria = $pengajuan->kriteria ?? [];
        
        // Cek pendidikan
        $tingkat_pendidikan = [
            'SD' => 1, 'SMP' => 2, 'SMA/SMK' => 3, 
            'D3' => 4, 'S1' => 5, 'S2' => 6
        ];
        
        $pendidikan_pelamar = $tingkat_pendidikan[$pelamar->pendidikan_terakhir] ?? 0;
        $pendidikan_required = $tingkat_pendidikan[$kriteria['pendidikan'] ?? 'SMA/SMK'] ?? 0;
        
        if ($pendidikan_pelamar < $pendidikan_required) {
            return false;
        }
        
        // Cek jurusan jika diperlukan
        if (!empty($kriteria['jurusan']) && !str_contains(strtolower($pelamar->jurusan), strtolower($kriteria['jurusan']))) {
            // Tidak langsung false, karena mungkin masih relevan
            // Bisa ditambahkan logika fuzzy matching
        }
        
        // Cek IPK jika ada
        if (!empty($kriteria['ipk']) && $pelamar->formulirJawaban) {
            $ipkPelamar = $pelamar->formulirJawaban->where('field_name', 'ipk')->first();
            if ($ipkPelamar && floatval($ipkPelamar->jawaban) < floatval($kriteria['ipk'])) {
                return false;
            }
        }
        
        return true;
    }
    
    private function sendEmailLolos(Pelamar $pelamar, $psikotestLink)
    {
        try {
            Mail::send('emails.pelamar_lolos', [
                'pelamar' => $pelamar,
                'psikotestLink' => $psikotestLink
            ], function ($message) use ($pelamar) {
                $message->to($pelamar->email)
                        ->subject('Selamat! Anda Lolos Seleksi Administrasi - Dagsap Recruitment');
            });
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
        }
    }
    
    private function sendEmailDitolak(Pelamar $pelamar)
    {
        try {
            Mail::send('emails.pelamar_ditolak', [
                'pelamar' => $pelamar
            ], function ($message) use ($pelamar) {
                $message->to($pelamar->email)
                        ->subject('Informasi Hasil Seleksi - Dagsap Recruitment');
            });
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
        }
    }
}