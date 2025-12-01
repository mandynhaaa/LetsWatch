@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
    @if (session('error'))
        <p style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif
    <h1>Criar Novo Grupo</h1>
    <form method="POST" action="{{ route('groups.store') }}">
        @csrf
        <div>
            <label for="name">Nome do Grupo</label>
            <input id="name" type="text" name="name" required autofocus>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Criar Grupo</button>
    </form>
    <hr>
    <h2>Entrar em um Grupo Existente</h2>
    <form method="POST" action="{{ route('groups.join') }}">
        @csrf
        <div>
            <label for="code">Código de Convite</label>
            <input id="code" type="text" name="code" required>
            @error('code')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Entrar</button>
    </form>
@endsection