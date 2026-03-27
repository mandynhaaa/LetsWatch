@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-black py-12">
    
    @if ($movie)
        <div class="fixed inset-0 z-0 bg-cover bg-center blur-[100px] opacity-30 scale-110" 
             style="background-image: url('{{ $posterBaseUrl . $movie['poster_path'] }}');">
        </div>

        <div class="relative z-10 w-full max-w-[350px] px-4">
            <div class="draggable-card relative aspect-[2/3] w-full rounded-[40px] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.8)] border border-white/10 bg-neutral-900"
                 data-movie-id="{{ $movie['id'] }}">
                
                <span class="badge like absolute top-10 left-6 px-4 py-2 rounded-xl border-4 border-green-500 text-green-500 font-black text-3xl -rotate-12 opacity-0 transition-opacity z-30">LIKE</span>
                <span class="badge nope absolute top-10 right-6 px-4 py-2 rounded-xl border-4 border-red-500 text-red-500 font-black text-3xl rotate-12 opacity-0 transition-opacity z-30">NOPE</span>

                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500" 
                     style="background-image:url('{{ $posterBaseUrl . $movie['poster_path'] }}');">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent flex flex-col justify-end p-8">
                        <h2 class="text-2xl font-black text-white mb-2">{{ $movie['title'] }}</h2>
                        <div class="flex items-center gap-2 text-sm font-bold text-gray-300 mb-3">
                            <svg class="w-4 h-4 text-yellow-500" 
                                viewBox="0 0 20 20" 
                                fill="currentColor" 
                                aria-hidden="true">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            {{ number_format($movie['vote_average'], 1) }} • {{ $genreNames }}
                        </div>
                        <div class="relative">
                            <p id="movie-overview" class="text-xs text-gray-400 line-clamp-3 leading-relaxed opacity-90 transition-all duration-300">
                                {{ $movie['overview'] ?? 'Descrição não disponível.' }}
                            </p>
                            
                            @if(isset($movie['overview']) && strlen($movie['overview']) > 100)
                                <button type="button" id="btn-expand" class="text-[10px] text-white font-bold mt-1 uppercase tracking-wider opacity-70 hover:opacity-100">
                                    Ler mais
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <form id="form-like" method="POST" action="{{ route('swipe') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}">
                    <input type="hidden" name="type" value="like">
                </form>
                <form id="form-dislike" method="POST" action="{{ route('swipe') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}">
                    <input type="hidden" name="type" value="dislike">
                </form>
            </div>
        </div>

        <div class="relative z-20 flex items-center gap-6 mt-4">
            <button class="w-16 h-16 rounded-full border-2 border-[#ff4b4b]/50 text-[#ff4b4b] flex items-center justify-center bg-black/20 backdrop-blur-md hover:bg-[#ff4b4b] hover:text-white transition-all duration-300 group" id="btn-nope">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>

            @if ($trailerUrl)
                <a href="{{ $trailerUrl }}" target="_blank" class="w-20 h-20 rounded-full border-2 border-white/50 text-white flex items-center justify-center bg-black/20 backdrop-blur-md hover:bg-white hover:text-black transition-all duration-300 shadow-xl" id="btn-trailer">
                    <svg class="w-10 h-10 fill-current ml-1" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </a>
            @endif

            <button class="w-16 h-16 rounded-full border-2 border-[#2de38c]/50 text-[#2de38c] flex items-center justify-center bg-black/20 backdrop-blur-md hover:bg-[#2de38c] hover:text-white transition-all duration-300 group" id="btn-like">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </div>
    @else
        <div class="relative z-10 text-center space-y-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" xmlns:bx="https://boxy-svg.com">
            <defs>
                <bx:guide x="136.22" y="187.26" angle="0"/>
                <bx:guide x="212.762" y="215.049" angle="0"/>
                <bx:guide x="230.586" y="224.52" angle="0"/>
                <bx:guide x="152.677" y="211.649" angle="0"/>
                <bx:guide x="165" y="208.226" angle="0"/>
                <bx:guide x="199.915" y="216.715" angle="0"/>
                <bx:export>
                <bx:file format="svg" path="Sem título.svg"/>
                </bx:export>
            </defs>
            <path style="fill: rgb(216, 216, 216); paint-order: fill; stroke: rgb(216, 216, 216);" d="M 418.498 187.864 L 354.404 492.545 L 333.004 492.611 L 382.48 187.864 L 418.498 187.864 Z M 138.339 493.206 L 79.645 187.864 L 109.428 187.864 L 158.99 493.144 L 138.339 493.206 Z M 369.229 187.864 L 319.749 492.649 L 296.706 492.721 L 333.968 187.864 L 369.229 187.864 Z M 172.231 493.102 L 122.674 187.864 L 159.965 187.864 L 197.266 493.024 L 172.231 493.102 Z M 320.788 187.864 L 283.52 492.762 L 268.521 492.808 L 281.012 187.864 L 320.788 187.864 Z M 239.95 492.895 L 227.459 187.864 L 267.916 187.864 L 255.424 492.85 L 239.95 492.895 Z M 210.438 492.986 L 173.144 187.864 L 214.361 187.864 L 226.857 492.937 L 210.438 492.986 Z"/>
            <rect x="79.159" y="165.259" width="338.853" height="13.472" style="fill: rgb(216, 216, 216); stroke: rgb(216, 216, 216);"/>
            <path d="M 79.785 155.635 C 72.5 146.271 68.235 134.917 68.235 122.683 C 68.235 90.565 97.614 64.534 133.859 64.534 C 138.371 64.534 142.773 64.937 147.026 65.705 C 146.998 64.993 146.987 64.283 146.987 63.563 C 146.987 31.447 176.37 5.416 212.61 5.416 C 231.741 5.416 248.958 12.671 260.95 24.241 C 272.713 14.374 288.592 8.324 306.066 8.324 C 342.306 8.324 371.689 34.356 371.689 66.471 C 371.689 69.915 371.351 73.288 370.704 76.567 C 400.104 82.329 422.094 105.558 422.094 133.342 C 422.094 141.239 420.317 148.769 417.096 155.635 L 328.637 155.635 L 328.637 155.733 L 149.084 155.733 L 149.084 155.635 L 79.785 155.635 Z" style="fill: rgb(216, 216, 216); stroke: rgb(216, 216, 216);"/>
            </svg>
            <h3 class="text-xl font-bold text-white">Fim da sessão!</h3>
            <p class="text-gray-400">Você já viu todos os filmes por hoje.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
    @vite('resources/js/cards.js')
@endpush