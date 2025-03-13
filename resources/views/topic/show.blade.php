<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $topic->judul_topic }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Dibuat oleh {{ $topic->author->username }} pada {{ \Carbon\Carbon::parse($topic->tanggal_dibuat)->format('d M Y') }}</p>
    
                @if($topic->topic_img)
                    <img src="{{ asset('storage/' . $topic->topic_img) }}" alt="Topic Image" class="w-full h-auto mb-4 rounded-lg">
                @endif
    
                <div class="text-lg text-gray-700 mb-4">
                    {!! nl2br(e($topic->isi_topic)) !!}
                </div>
            </div>
    
            <!-- Comment Section -->
            <div class="px-6 py-4 bg-gray-50">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h2>
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display Comments -->
                @forelse ($comments as $comment)
                    <div class="mb-4 border-b pb-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                            <strong>{{ $comment->author->username }}</strong> pada {{ \Carbon\Carbon::parse($comment->tanggal_dibuat)->diffForHumans() }}
                        </p>
                        <p class="text-gray-700 ">{{ $comment->comment }}</p>
                        @if (auth()->check() && auth()->id() === $comment->id_commenter)
                            @if(auth()->user()->canany(['comment-destroy']))
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">Belum ada komentar.</p>
                @endforelse

                <!-- Add Comment Form -->

                @if(auth()->user()->canany(['comment-store']))
                <form action="{{ route('comment.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="id_topic" value="{{ $topic->id }}">
                    <input type="hidden" name="id_commenter" value="{{ auth()->id() }}">

                    <div class="mb-4">
                        <textarea name="comment" rows="4" class="w-full p-3 rounded-lg text-gray-800 bg-gray-200 @error('comment') border-red-500 @enderror" placeholder="Tambahkan komentar...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
