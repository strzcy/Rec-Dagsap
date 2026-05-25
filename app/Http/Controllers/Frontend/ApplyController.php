<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\FormulirJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        
        try {
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
                $pelamar->update(['status' => 'lolos_tahap1']);
                
                return redirect()->route('frontend.apply.success', $pelamar)
                    ->with('success', 'Selamat! Anda lolos seleksi administrasi. Silakan cek email untuk informasi selanjutnya.');
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
        return view('frontend.apply.success', compact('pelamar'));
    }
    
    private function checkKelulusan(Pelamar $pelamar, Lowongan $lowongan)
    {
        $pengajuan = $lowongan->pengajuan;
        $kriteria = is_array($pengajuan->kriteria) ? $pengajuan->kriteria : json_decode($pengajuan->kriteria, true);
        
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
        
        return true;
    }
    
    public function detail(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'publikasi' || $lowongan->tanggal_selesai < now()) {
            return redirect('/')->with('error', 'Lowongan sudah tidak tersedia.');
        }
        
        return view('frontend.detail', compact('lowongan'));
    }
}