@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
@if (session('error'))
    <p class="text-center text-red-500 font-semibold">{{ session('error') }}</p>
@endif

<div class="card-stack max-w-lg mx-auto mt-10">
    @if ($movie)
        <div class="draggable-card" data-movie-id="{{ $movie['id'] }}">

            <span class="badge like">LIKE</span>
            <span class="badge nope">NOPE</span>

            @if ($movie['poster_path'])
                <div class="card-media"
                    style="background-image:url('{{ $posterBaseUrl . $movie['poster_path'] }}')"></div>
            @else
                <div class="card-media flex items-center justify-center text-gray-400 italic">
                    Poster indisponível.
                </div>
            @endif

            <div class="card-body">
                <h2>{{ $movie['title'] }}</h2>

                <p class="rating">
                    ⭐ {{ number_format($movie['vote_average'], 1) }}
                </p>

                <p class="genres">
                    Gêneros: {{ $genreNames }}
                </p>

                <p class="overview">
                    {{ $movie['overview'] ?? 'Descrição não disponível.' }}
                </p>
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
    @else
        <p class="text-center text-white font-bold text-lg p-6">
            Você avaliou todos os filmes populares disponíveis! Volte mais tarde.
        </p>
    @endif
</div>

<div class="controls mt-6 flex justify-center gap-6">
    <button class="btn ghost" id="btn-nope">👎</button>
    <button class="btn" id="btn-like">👍</button>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/cards.js') }}" defer></script>
@endpush
