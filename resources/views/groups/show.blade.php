@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="group-page">
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <main class="groups-main">
        <div class="group-header">
            <div>
                <h1 class="title">{{ $group->name }}</h1>
                <p class="invite-code">Código de Convite: <b>{{ $group->invite_code }}</b></p>
            </div>
        </div>

        <div class="section-header">
            <h2 class="sub-title">Filmes em Comum</h2>
            @if (count($moviesDetails) > 0)
                <p class="muted">Total: {{ count($moviesDetails) }}</p>
            @endif
        </div>

        @if (count($moviesDetails) > 0)
            <div class="movies-grid">
                @foreach ($moviesDetails as $movie)
                    <div class="movie-card">
                        <a href="{{ route('groups.feedback.create', ['group' => $group->id, 'tmdbMovieId' => $movie['id']]) }}">
                            <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                            <h3>{{ $movie['title'] }}</h3>
                        </a>
                        <p class="movie-genre">{{ $movie['genres'] }}</p>
                        <p class="movie-release">Lançamento: {{ $movie['release_date'] }}</p>
                        <p class="movie-rating">★ {{ $movie['vote_average'] }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="muted">Nenhum filme curtido ainda.</p>
        @endif
    </main>
    <aside class="group-sidebar">
        <div class="sidebar-card">
            <h3 class="sub-title">Membros do Grupo</h3>
            <ul class="members-list">
                @foreach ($group->members as $member)
                    <li>
                        {{ $member->name }}
                        @if ($member->id === $group->created_by_user_id)
                            <span class="badge-owner">Criador</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
@endsection