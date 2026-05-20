<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PelamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelamar::with(['lowongan.pengajuan.divisi']);
        
        if ($request->has('lowongan_id') && $request->lowongan_id != '') {
            $query->where('lowongan_id', $request->lowongan_id);
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }
        
        $pelamars = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $lowongans = Lowongan::where('hrd_id', auth()->id())->get();
        
        return view('hrd.pelamar.index', compact('pelamars', 'lowongans'));
    }

    public function show(Pelamar $pelamar)
    {
        // Cek apakah pelamar ini dari lowongan HRD yang login
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
        
        $lowongans = Lowongan::where('hrd_id', auth()->id())->get();
        
        return view('hrd.pelamar.show', compact('pelamar', 'lowongans'));
    }

    public function kirimJadwalInterview(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'tanggal_interview' => 'required|date',
            'waktu_interview' => 'required',
            'lokasi_interview' => 'required|string',
            'catatan' => 'nullable|string'
        ]);

        $tanggal = $request->tanggal_interview;
        $waktu = $request->waktu_interview;
        $lokasi = $request->lokasi_interview;
        
        // Format nomor telepon
        $noTelepon = $pelamar->no_telepon;
        if (substr($noTelepon, 0, 1) === '0') {
            $noTelepon = '62' . substr($noTelepon, 1);
        }
        if (substr($noTelepon, 0, 2) !== '62') {
            $noTelepon = '62' . $noTelepon;
        }
        
        $message = "Selamat! Anda dinyatakan lolos seleksi administrasi dan psikotest di Dagsap Recruitment.%0A%0A";
        $message .= "Apakah Anda bersedia mengikuti interview lebih lanjut pada:%0A";
        $message .= "📅 Tanggal: {$tanggal}%0A";
        $message .= "⏰ Waktu: {$waktu}%0A";
        $message .= "📍 Lokasi: {$lokasi}%0A%0A";
        
        if ($request->filled('catatan')) {
            $message .= "📝 Catatan: " . $request->catatan . "%0A%0A";
        }
        
        $message .= "Silakan balas YES jika bersedia atau NO jika tidak bersedia.%0A%0A";
        $message .= "Terima kasih.";

        // Update status pelamar
        $pelamar->update([
            'status' => 'interview',
            'catatan' => "Interview dijadwalkan pada {$tanggal} {$waktu} di {$lokasi}" . ($request->catatan ? "\nCatatan: " . $request->catatan : '')
        ]);
        
        // Simpan log pengiriman
        Log::info('WhatsApp message prepared for: ' . $noTelepon);
        
        // Kirim WhatsApp via API (redirect ke WhatsApp Web)
        $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $noTelepon . "&text=" . $message;
        
        // Kirim email juga sebagai backup
        $this->sendEmailInterview($pelamar, $tanggal, $waktu, $lokasi);
        
        return redirect()->route('hrd.pelamar.show', $pelamar)
            ->with('success', 'Jadwal interview berhasil disiapkan!')
            ->with('whatsapp_url', $whatsappUrl);
    }
    
    public function updateStatus(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'status' => 'required|in:pending,lolos_tahap1,psikotest,lolos_psikotest,interview,diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);
        
        $pelamar->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);
        
        // Jika status diterima, kirim email pemberitahuan
        if ($request->status == 'diterima') {
            $this->sendEmailDiterima($pelamar);
        }
        
        return redirect()->route('hrd.pelamar.show', $pelamar)
            ->with('success', 'Status pelamar berhasil diupdate!');
    }
    
    public function downloadCv(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
        
        $path = storage_path('app/public/' . $pelamar->cv_path);
        if (file_exists($path)) {
            return response()->download($path, 'CV_' . $pelamar->nama_lengkap . '.pdf');
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }
    
    public function downloadIjazah(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
        
        $path = storage_path('app/public/' . $pelamar->ijazah_path);
        if (file_exists($path)) {
            return response()->download($path, 'Ijazah_' . $pelamar->nama_lengkap . '.pdf');
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }
    
    private function sendEmailInterview($pelamar, $tanggal, $waktu, $lokasi)
    {
        try {
            Mail::send('emails.pelamar_interview', [
                'pelamar' => $pelamar,
                'tanggal' => $tanggal,
                'waktu' => $waktu,
                'lokasi' => $lokasi
            ], function ($message) use ($pelamar) {
                $message->to($pelamar->email)
                        ->subject('Jadwal Interview - Dagsap Recruitment');
            });
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email interview: ' . $e->getMessage());
        }
    }
    
    private function sendEmailDiterima($pelamar)
    {
        try {
            Mail::send('emails.pelamar_diterima', [
                'pelamar' => $pelamar
            ], function ($message) use ($pelamar) {
                $message->to($pelamar->email)
                        ->subject('Selamat! Anda Diterima - Dagsap Recruitment');
            });
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email diterima: ' . $e->getMessage());
        }
    }
}