<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HRD\KirimJadwalInterviewRequest;
use App\Http\Requests\HRD\UpdatePelamarStatusRequest;

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
        Gate::authorize('view', $pelamar);
        
        $lowongans = Lowongan::where('hrd_id', auth()->id())->get();
        
        return view('hrd.pelamar.show', compact('pelamar', 'lowongans'));
    }

    public function kirimJadwalInterview(KirimJadwalInterviewRequest $request, Pelamar $pelamar)
    {
        Gate::authorize('updateStatus', $pelamar);

        $tanggal = $request->tanggal_interview;
        $waktu = $request->waktu_interview;
        $lokasi = $request->lokasi_interview;
        
        $noTelepon = $pelamar->no_telepon;
        if (substr($noTelepon, 0, 1) === '0') {
            $noTelepon = '62' . substr($noTelepon, 1);
        }
        if (substr($noTelepon, 0, 2) !== '62') {
            $noTelepon = '62' . $noTelepon;
        }
        
        $message = "Selamat! Anda dinyatakan lolos seleksi administrasi di PT Dagsap Endura Eatore.%0A%0A";
        $message .= "Apakah Anda bersedia mengikuti tahap selanjutnya pada:%0A";
        $message .= "📅 Tanggal: {$tanggal}%0A";
        $message .= "⏰ Waktu: {$waktu}%0A";
        $message .= "📍 Lokasi: {$lokasi}%0A%0A";
        
        if ($request->filled('catatan')) {
            $message .= "📝 Catatan: " . $request->catatan . "%0A%0A";
        }
        
        $message .= "Kami tunggu balasan dari Anda.%0A%0A";
        $message .= "Terima kasih.";

        $pelamar->update([
            'status' => 'interview',
            'catatan' => "Tahap Lanjutan dijadwalkan pada {$tanggal} {$waktu} di {$lokasi}" . ($request->catatan ? "\nCatatan: " . $request->catatan : '')
        ]);
        
        Log::info('WhatsApp message prepared for: ' . $noTelepon);
        
        $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $noTelepon . "&text=" . $message;
        
        $this->sendEmailInterview($pelamar, $tanggal, $waktu, $lokasi);
        
        return redirect()->route('hrd.pelamar.show', $pelamar)
            ->with('success', 'Jadwal interview berhasil disiapkan!')
            ->with('whatsapp_url', $whatsappUrl);
    }
    
    public function updateStatus(UpdatePelamarStatusRequest $request, Pelamar $pelamar)
    {
        Gate::authorize('updateStatus', $pelamar);
        
        $pelamar->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);
        
        if ($request->status == 'diterima') {
            $this->sendEmailDiterima($pelamar);
        }
        
        return redirect()->route('hrd.pelamar.show', $pelamar)
            ->with('success', 'Status pelamar berhasil diupdate!');
    }
    
    // DOWNLOAD CV - HANYA 1 METHOD
    public function downloadCv(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
    
        $path = public_path($pelamar->cv_path);
        if (file_exists($path)) {
            $extension = pathinfo($pelamar->cv_path, PATHINFO_EXTENSION);
            $filename = 'CV_' . $pelamar->nama_lengkap . '.' . $extension;
            return response()->download($path, $filename);
        }
    
        return back()->with('error', 'File CV tidak ditemukan.');
    }

    // DOWNLOAD IJAZAH - HANYA 1 METHOD (HAPUS YANG DUPLIKAT)
    public function downloadIjazah(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
    
        $path = public_path($pelamar->ijazah_path);
        if (file_exists($path)) {
            $extension = pathinfo($pelamar->ijazah_path, PATHINFO_EXTENSION);
            $filename = 'Ijazah_' . $pelamar->nama_lengkap . '.' . $extension;
            return response()->download($path, $filename);
        }
    
        return back()->with('error', 'File Ijazah tidak ditemukan.');
    }

    // PREVIEW CV (Opsional, jika perlu)
    public function previewCv(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
    
        $path = public_path($pelamar->cv_path);
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        return abort(404, 'File tidak ditemukan.');
    }

    // PREVIEW IJAZAH (Opsional, jika perlu)
    public function previewIjazah(Pelamar $pelamar)
    {
        if ($pelamar->lowongan->hrd_id !== auth()->id()) {
            abort(403);
        }
    
        $path = public_path($pelamar->ijazah_path);
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        return abort(404, 'File tidak ditemukan.');
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

    public function printData(Pelamar $pelamar)
    {
        Gate::authorize('print', $pelamar);
    
        return view('hrd.pelamar.print', compact('pelamar'));
    }
}