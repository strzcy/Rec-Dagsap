@extends('layouts.frontend')

@section('title', 'Psikotest - Dagsap Recruitment')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl mt-16">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-primary text-white p-4">
            <h1 class="text-2xl font-bold">Tes Psikotest Online</h1>
            <p class="text-sm opacity-90">PT Dagsap Endura Eatore</p>
        </div>
        
        <div class="p-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-blue-800 text-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    Silakan kerjakan tes psikotest berikut dengan jujur dan teliti. Waktu pengerjaan tidak terbatas.
                </p>
            </div>
            
            <!-- Google Form Embed -->
            <div class="w-full">
                <iframe 
                    src="https://docs.google.com/forms/d/e/1FAIpQLSdummy/viewform?embedded=true" 
                    width="100%" 
                    height="800" 
                    frameborder="0" 
                    marginheight="0" 
                    marginwidth="0">
                    Loading…
                </iframe>
            </div>
            
            <div class="mt-6 pt-4 border-t text-center">
                <form action="{{ route('frontend.apply.submit_psikotest', $pelamar) }}" method="POST" id="psikotestForm">
                    @csrf
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="selesai" value="1" required class="mr-2">
                            <span class="text-sm">Saya menyatakan telah menyelesaikan psikotest dengan jujur dan sesuai kemampuan saya <span class="text-red-500">*</span></span>
                        </label>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-check-circle mr-2"></i> Selesai & Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection