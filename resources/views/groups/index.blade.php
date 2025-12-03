@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="groups-page">
    <div class="groups-header">
        <h1 class="title">Meus Grupos</h1>
        <a href="{{ route('groups.create') }}" class="btn-primary">
            + Novo Grupo
        </a>
    </div>
    @if ($allGroups->count() > 0)
        <ul class="group-list">
            @foreach ($allGroups as $group)
                <li class="group-card">
                    <a href="{{ route('groups.show', $group) }}" class="group-link">
                        <div class="group-info">
                            <h3>{{ $group->name }}</h3>
                            <p class="members">Membros: {{ $group->members->count() }}</p>
                        </div>
                        @if ($group->created_by_user_id === Auth::id())
                            <span class="badge-owner">Criador</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty-message">
            Você ainda não pertence a nenhum grupo.<br>
            Crie um novo ou entre usando um código de convite!
        </p>
    @endif
</div>
@endsection
