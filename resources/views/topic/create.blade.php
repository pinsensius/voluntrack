<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Make Topic!') }}
        </h2>
    </x-slot>

    <style>
        
    </style>
    <div class="mx-40 py-12">
        <div class="max-w-xl mx-auto p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-100 mb-6 text-black">Buat Topic Baru</h2>
            
            <form action="{{ route('topic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <!-- Author ID (Auto set to Auth User) -->
                <div class="mb-4">
                    <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">
                </div>
    
                <!-- Judul Topic -->
                <div class="mb-4">
                    <label for="judul_topic" class="block text-sm font-medium text-black">Judul Topic</label>
                    <input type="text" name="judul_topic" id="judul_topic" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('judul_topic') border-red-500 @enderror" placeholder="Masukkan judul topic" value="{{ old('judul_topic') }}">
                    @error('judul_topic')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Isi Topic -->
                <div class="mb-4">
                    <label for="isi_topic" class="block text-sm font-medium text-black">Isi Topic</label>
                    <textarea name="isi_topic" id="isi_topic" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('isi_topic') border-red-500 @enderror" rows="5" placeholder="Tulis isi topic...">{{ old('isi_topic') }}</textarea>
                    @error('isi_topic')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Gambar Topic -->
                <div class="mb-4">
                    <label for="topic_img" class="block text-sm font-medium text-black">Upload Gambar (Opsional)</label>
                    <input type="file" name="topic_img" id="topic_img" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('topic_img') border-red-500 @enderror">
                    @error('topic_img')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Tanggal Dibuat -->
                <input type="date" name="tanggal_dibuat" id="" value="{{now()->toDateString()}}" hidden>
                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 text-black rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 fw-bold" style="background-color: #AEF161;">Simpan Topic</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
