@extends('layouts.app')
@section('content')
    <h1>Feedback para: {{ $movieDetails['title'] }}</h1>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <div style="margin-bottom: 20px;">
        <img src="{{ $movieDetails['poster_path'] }}" alt="{{ $movieDetails['title'] }}" style="max-width: 150px; border-radius: 8px;">
    </div>
    <form method="POST" action="{{ route('groups.feedback.store', ['group' => $group->id, 'tmdbMovieId' => $movieDetails['id']]) }}">
        @csrf
        <div>
            <label for="rating">Nota (1 a 10):</label>
            <input 
                type="number" 
                id="rating" 
                name="rating" 
                min="1" 
                max="10" 
                required
                value="{{ old('rating', $existingFeedback->rating ?? '') }}" 
                style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
            >
            @error('rating') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>
        <div>
            <label for="comment">Comentário (Opcional):</label>
            <textarea 
                id="comment" 
                name="comment" 
                rows="4" 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
            >{{ old('comment', $existingFeedback->comment ?? '') }}</textarea>
            @error('comment') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            {{ $existingFeedback ? 'Atualizar Feedback' : 'Salvar Feedback' }}
        </button>
    </form>
@endsection