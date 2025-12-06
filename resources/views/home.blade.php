@extends('layouts.app')

@section('nav')
@endsection

@section('content')

@php
    $posterUrl = $movie && $movie['poster_path'] ? $posterBaseUrl . $movie['poster_path'] : asset('images/default-bg.jpg');
@endphp

<div class="cinema-bg-layer" style="background-image: url('{{ $posterUrl }}');"></div>

<header class="cinema-header">
    <div class="logo-area">
        <a href="{{ url('/') }}">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="Lets Watch" style="height: 135px; margin-left: -40px; width: auto; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.5));">
            @else
                <h2 style="color: #e50914; font-weight: bold; margin: 0; font-size: 1.4rem;">LET'S WATCH</h2>
            @endif
        </a>
    </div>
    <nav class="cinema-nav-links">
        <a href="{{ url('/') }}" class="nav-link">Início</a>
        <a href="{{ url('/groups') }}" class="nav-link">Grupos</a>
        <a href="{{ url('/account') }}" class="nav-link">Conta</a>
    </nav>
</header>

<div class="cinema-wrapper">
    @if (session('error'))
        <div style="position: absolute; top: 80px; z-index: 200; background: #dc2626; color: white; padding: 12px 24px; border-radius: 8px;">
            {{ session('error') }}
        </div>
    @endif

    @if ($movie)
        <div class="glass-panel draggable-card" data-movie-id="{{ $movie['id'] }}">
            <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }}" class="glass-poster">
            <h1 class="cinema-title">{{ $movie['title'] }}</h1>
            <div class="cinema-meta">
                PG-13 • ⭐ {{ number_format($movie['vote_average'], 1) }} • {{ \Illuminate\Support\Str::limit($genreNames, 25) }}
            </div>
            
            <div class="desc-container">
                <div class="cinema-desc" id="movie-desc">
                    {{ $movie['overview'] ?? 'Sem descrição disponível.' }}
                </div>
                @if(strlen($movie['overview'] ?? '') > 100)
                   <button class="toggle-desc-btn" id="toggle-btn" onclick="toggleDescription()">Ler mais...</button>
                @endif
            </div>
        </div>

        <div class="action-buttons-container">
            <button class="circle-btn btn-dislike" id="btn-nope">
                <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </button>

            @if ($trailerUrl)
                <a href="{{ $trailerUrl }}" target="_blank" class="circle-btn btn-watch" title="Assistir Trailer">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                </a>
            @else
                <button class="circle-btn btn-watch" disabled style="color:#666; border-color:#444;">
                    <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
            @endif

            <button class="circle-btn btn-like" id="btn-like">
                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
        </div>

        <form id="form-like" method="POST" action="{{ route('swipe') }}" class="hidden" style="display:none;">
            @csrf <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}"> <input type="hidden" name="type" value="like">
        </form>
        <form id="form-dislike" method="POST" action="{{ route('swipe') }}" class="hidden" style="display:none;">
            @csrf <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}"> <input type="hidden" name="type" value="dislike">
        </form>

    @else
        <div class="glass-panel empty-state">
            <h2 style="color:white;">🎬 Lista Zerada!</h2>
        </div>
    @endif
</div>

@endsection

@push('scripts')
    @vite('resources/js/cards.js')
    
    <script>
        function toggleDescription() {
            var desc = document.getElementById('movie-desc');
            var btn = document.getElementById('toggle-btn');

            if (!desc || !btn) return;

            desc.classList.toggle('expanded');

            if (desc.classList.contains('expanded')) {
                btn.innerText = "LER MENOS";
            } else {
                btn.innerText = "LER MAIS...";
            }
        }
    </script>
@endpush