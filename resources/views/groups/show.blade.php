@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
    <h1 class="title">Grupo {{ $group->name }}</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <button id="toggle-invite-{{ $group->id }}" type="button" style="padding:10px; cursor:pointer;" aria-expanded="false">
        Mostrar código de convite
    </button>
    <div id="invite-code-{{ $group->id }}" style="display: none; margin-top: 10px;">
        <h2>Código de Convite: <strong>{{ $group->invite_code }}</strong></h2>
        <p>Compartilhe este código para que outros usuários entrem no grupo.</p>
    </div>
    <script>
        (function(){
            var btn = document.getElementById('toggle-invite-{{ $group->id }}');
            var box = document.getElementById('invite-code-{{ $group->id }}');
            if (!btn || !box) return;
            btn.addEventListener('click', function () {
                var isHidden = box.style.display === 'none' || box.style.display === '';
                box.style.display = isHidden ? 'block' : 'none';
                btn.textContent = isHidden ? 'Ocultar código de convite' : 'Mostrar código de convite';
                btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });
        })();
    </script>
    <hr>
    <button id="toggle-members-{{ $group->id }}" type="button" style="padding:10px; cursor:pointer;" aria-expanded="false">
        Mostrar membros
    </button>
    <div id="members-list-{{ $group->id }}" style="display: none; margin-top:10px;">
        Quantidade: ({{ $group->members->count() }})
        <ul>
            @foreach ($group->members as $member)
                <li>
                    {{ $member->name }}
                    @if ($member->id === $group->created_by_user_id)
                        (Criador)
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        (function(){
            var btn = document.getElementById('toggle-members-{{ $group->id }}');
            var list = document.getElementById('members-list-{{ $group->id }}');
            if (!btn || !list) return;
            btn.addEventListener('click', function () {
                var isHidden = list.style.display === 'none' || list.style.display === '';
                list.style.display = isHidden ? 'block' : 'none';
                btn.textContent = isHidden ? 'Ocultar membros' : 'Mostrar membros';
                btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });
        })();
    </script>
    <hr>
    <h1>Filmes Curtidos pelo Grupo</h1>
    @if (count($moviesDetails) > 0)
        <p>Total de Filmes Curtidos: {{ count($moviesDetails) }}</p>
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        @foreach ($moviesDetails as $movie)
            <div style="width: 200px; padding: 10px; border: 1px solid #ccc; border-radius: 8px; text-align: center;">
                <a href="{{ route('groups.feedback.create', ['group' => $group->id, 'tmdbMovieId' => $movie['id']]) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" style="width: 100%; border-radius: 4px;">
                    <h3 style="font-size: 1.1em; margin: 10px 0 5px;">{{ $movie['title'] }}</h3>
                </a>
                <p style="font-size: 0.9em; color: #666;">Lançamento: {{ $movie['release_date'] }}</p>
                <p style="font-size: 16px; margin: 0; color: #ffc107;">★ {{ $movie['vote_average'] }}</p>
            </div>
        @endforeach
        </div>
    @else
        <p>Sem resultados.</p>
    @endif
@endsection