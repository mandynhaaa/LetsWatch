@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="container-center" style="margin-top: -50px">
    <div class="panel">
        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        <h1 class="title">Criar Novo Grupo</h1>
        <form method="POST" action="{{ route('groups.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Grupo</label>
                <input id="name" type="text" name="name" required autofocus>
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn">Criar Grupo</button>
        </form>
        <hr>
        <h1 class="title">Entrar em um Grupo Existente</h1>
        <form method="POST" action="{{ route('groups.join') }}">
            @csrf
            <div class="form-group">
                <label for="code">Código de Convite</label>
                <input id="code" type="text" name="code" required>
                @error('code')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</div>
@endsection