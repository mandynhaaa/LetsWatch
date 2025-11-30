@extends('layouts.app')
@section('content')
    @if (session('error'))
        <p style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif
    <div class="swipe-container" style="
        width: 40%; 
        max-width: 90%; 
        max-height: 90vh; 
        margin: 5vh auto; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 10px; 
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    ">
        @if ($movie)
            <div class="movie-card" style="
                text-align: center; 
                display: flex; 
                flex-direction: column; 
                height: 100%;
                overflow: hidden;
            ">
                @if ($movie['poster_path'])
                <div style="display:flex; justify-content:center;">
                    <img 
                        src="{{ $posterBaseUrl . $movie['poster_path'] }}" 
                        alt="{{ $movie['title'] }}" 
                        style="max-width: 100%; max-height: 48vh; height: auto; object-fit: cover; border-radius: 8px; display: block;"
                    >
                </div>
                @else
                <p>Poster indisponível.</p>
                @endif
                <h2 style="font-size: 20px; font-weight: bold; margin: 10px 0 6px;">{{ $movie['title'] }}</h2>
                <p style="font-size: 16px; margin: 0 0 10px; color: #ffc107;">
                    ★ {{ number_format($movie['vote_average'], 1) }}
                </p>
                <p style="font-size: 14px; color: #555; font-style: italic; margin-bottom: 10px;">
                    Gêneros: {{ $genreNames }} 
                </p>
                <p style="
                    margin-top: 0; 
                    overflow-y: auto;
                    flex-grow: 1;
                    max-height: 150px;
                    text-align: left; 
                    padding: 0 10px;
                ">
                    {{ $movie['overview'] ?? 'Descrição não disponível.' }}
                </p>
                <div style="display: flex; justify-content: space-between; margin-top: auto; padding: 14px 0;">
                    <form method="POST" action="{{ route('swipe') }}">
                        @csrf
                        <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}">
                        <input type="hidden" name="type" value="dislike">
                        <button type="submit" 
                            style="padding: 10px 20px; border: none; border-radius: 50px; background-color: #ff4d4d; color: white; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                            &#128078; DISLIKE
                        </button>
                    </form>
                    <form method="POST" action="{{ route('swipe') }}">
                        @csrf
                        <input type="hidden" name="tmdb_movie_id" value="{{ $movie['id'] }}">
                        <input type="hidden" name="type" value="like">
                        <button type="submit" 
                            style="padding: 10px 20px; border: none; border-radius: 50px; background-color: #4CAF50; color: white; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                            &#128077; LIKE
                        </button>
                    </form>
                </div>
            </div>
        @else
            <p style="text-align: center; font-weight: bold; font-size: 1.2em;">
                Você avaliou todos os filmes populares disponíveis no momento! Volte mais tarde.
            </p>
        @endif
    </div>
@endsection