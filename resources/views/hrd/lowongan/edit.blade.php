@extends('layouts.app')

@section('title', 'Edit Lowongan')

@section('header', 'Edit Lowongan')
@section('subheader', 'Perbarui informasi lowongan')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('hrd.lowongan.update', $lowongan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Lowongan *</label>
            <input type="text" name="judul" value="{{ old('judul', $lowongan->judul) }}" class="w-full border rounded-lg px-3 py-2" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner/Poster</label>
            @if($lowongan->banner_image)
            <div class="mb-2">
                <img src="{{ Storage::url($lowongan->banner_image) }}" class="h-32 rounded">
                <p class="text-xs text-gray-500 mt-1">Banner saat ini</p>
            </div>
            @endif
            <input type="file" name="banner_image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti banner</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lowongan *</label>
            <textarea name="deskripsi" rows="8" class="w-full border rounded-lg px-3 py-2" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $lowongan->tanggal_mulai->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $lowongan->tanggal_selesai->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status Lowongan</label>
            <select name="status" class="w-full border rounded-lg px-3 py-2">
                <option value="draft" {{ $lowongan->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="publikasi" {{ $lowongan->status == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                <option value="ditutup" {{ $lowongan->status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('hrd.lowongan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                Update Lowongan
            </button>
        </div>
    </form>
</div>
@endsection