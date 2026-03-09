@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
@if (session('error'))
    <p class="text-center text-red-500 font-semibold">{{ session('error') }}</p>
@endif
<div class="cinema-bg" style="background-image: url('{{ $posterBaseUrl . $movie['poster_path'] }}');"></div>
<div class="card-stack">
    @if ($movie)
        <div class="draggable-card" data-movie-id="{{ $movie['id'] }}">
            <span class="badge like">LIKE</span>
            <span class="badge nope">NOPE</span>
            @if ($movie['poster_path'])
                <div class="card-media" style="background-image:url('{{ $posterBaseUrl . $movie['poster_path'] }}');">
                    <div class="card-overlay">
                        <h2>{{ $movie['title'] }}</h2>
                        <div class="info">
                            ⭐ {{ number_format($movie['vote_average'], 1) }} • {{ $genreNames }}
                        </div>
                        <div class="small-overview">
                            {{ $movie['overview'] ?? 'Descrição não disponível.' }}
                        </div>
                    </div>
                </div>
            @else
                <div class="card-media flex items-center justify-center text-gray-400 italic">
                    Poster indisponível.
                </div>
            @endif
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
    @else
        <p class="text-center text-white font-bold text-lg p-6">
            Você avaliou todos os filmes populares disponíveis! Volte mais tarde.
        </p>
    @endif
</div>
<div class="controls">
    <button class="circle-btn dislike" id="btn-nope">
        <svg viewBox="0 0 24 24">
            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
        </svg>
    </button>
    @if ($trailerUrl)
        <a href="{{ $trailerUrl }}" target="_blank">
            <button class="circle-btn trailer" id="btn-trailer" title="Assistir Trailer">
                <svg viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </button>
        </a>
    @endif
    <button class="circle-btn like" id="btn-like">
        <svg viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </button>
</div>
@endsection

@push('scripts')
    @vite('resources/js/cards.js')
@endpush