@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">
            Feedback para: {{ $movieDetails['title'] }}
        </h1>
        <div class="flex justify-center mb-6">
            <img src="{{ $movieDetails['poster_path'] }}" 
                 alt="{{ $movieDetails['title'] }}" 
                 class="w-50 h-auto rounded-lg shadow-md object-cover border border-neutral-800">
        </div>
        <form method="POST" action="{{ route('groups.feedback.store', ['group' => $group->id, 'tmdbMovieId' => $movieDetails['id']]) }}">
            @csrf
            <div class="form-group">
                <label for="rating">
                    Nota (1 a 10):
                </label>
                <input 
                    type="number"
                    id="rating"
                    name="rating"
                    min="1"
                    max="10"
                    required
                    value="{{ old('rating', $existingFeedback->rating ?? '') }}"
                >
                @error('rating') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="comment">
                    Comentário (Opcional):
                </label>
                <textarea 
                    id="comment"
                    name="comment"
                    rows="4"
                >{{ old('comment', $existingFeedback->comment ?? '') }}</textarea>
                @error('comment') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="flex flex-col gap-4 mt-4">
                <button type="submit" class="btn">
                    {{ $existingFeedback ? 'Atualizar Dados' : 'Salvar Feedback' }}
                </button>
                <button type="button" onclick="window.history.back();" class="btn-secondary">
                    Voltar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection