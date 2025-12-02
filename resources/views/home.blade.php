@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
@if (session('error'))
    <p class="text-center text-red-500 font-semibold">{{ session('error') }}</p>
@endif
<div class="card-stack max-w-lg mx-auto">
    @if ($movie)
        <div class="draggable-card" data-movie-id="{{ $movie['id'] }}">

            <span class="badge like">LIKE</span>
            <span class="badge nope">NOPE</span>

            @if ($movie['poster_path'])
                <div class="card-media" style="background-image:url('{{ $posterBaseUrl . $movie['poster_path'] }}')">

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
    
@if ($movie)
    <div class="controls flex justify-center gap-6">
        <button class="circle-btn dislike" id="btn-nope">👎</button>
        <button class="circle-btn like" id="btn-like">👍</button>
    </div>
@endif

@endsection

@push('scripts')
    @vite('resources/js/cards.js')
@endpush
