@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="feedback-container">
    <h1 class="movie-title">Feedback para: {{ $movieDetails['title'] }}</h1>
    @if (session('error'))
        <p class="error-text">{{ session('error') }}</p>
    @endif
    <div class="movie-poster">
        <img src="{{ $movieDetails['poster_path'] }}" alt="{{ $movieDetails['title'] }}">
    </div>
    <form class="feedback-form" method="POST" action="{{ route('groups.feedback.store', ['group' => $group->id, 'tmdbMovieId' => $movieDetails['id']]) }}">
        @csrf
        <div class="form-group">
            <label for="rating">Nota (1 a 10):</label>
            <input 
                type="number"
                id="rating"
                name="rating"
                min="1"
                max="10"
                required
                value="{{ old('rating', $existingFeedback->rating ?? '') }}"
            >
            @error('rating') <span class="error-text">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="comment">Comentário (Opcional):</label>
            <textarea 
                id="comment"
                name="comment"
                rows="4"
            >{{ old('comment', $existingFeedback->comment ?? '') }}</textarea>
            @error('comment') <span class="error-text">{{ $message }}</span> @enderror
        </div>
        <div class="button-row">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                Voltar
            </button>
            <button type="submit" class="btn btn-primary">
                {{ $existingFeedback ? 'Atualizar Feedback' : 'Salvar Feedback' }}
            </button>
        </div>
    </form>
</div>
@endsection
