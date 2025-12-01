@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
    <h1 class="title">Meus Grupos</h1>
    <a href="{{ route('groups.create') }}" style="padding: 10px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">+ Novo Grupo</a>
    @if ($allGroups->count() > 0)
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            @foreach ($allGroups as $group)
                <li style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                    <a href="{{ route('groups.show', $group) }}">
                        <h3>{{ $group->name }}</h3>
                        <p>Membros: {{ $group->members->count() }}</p>
                        @if ($group->created_by_user_id === Auth::id())
                            <span style="color: green; font-weight: bold;">(Você é o Criador)</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p style="margin-top: 20px;">Você ainda não pertence a nenhum grupo. Crie um novo ou entre usando um código de convite!</p>
    @endif   
@endsection