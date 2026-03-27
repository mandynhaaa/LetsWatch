@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Criar Novo Grupo</h1>
        <form method="POST" action="{{ route('groups.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Grupo</label>
                <input id="name" type="text" name="name" required autofocus>
                @error('name')
                    <x-alert-error :message="$message" />
                @enderror
            </div>
            <button type="submit" class="btn">Criar Grupo</button>
        </form>
        <div class="flex flex-col gap-4 mt-4">
            <hr>
            <h1 class="title-secondary">Entrar em um Grupo Existente</h1>
            <form method="POST" action="{{ route('groups.join') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Código de Convite</label>
                    <input id="code" type="text" name="code" required>
                    @error('code') <x-alert-error :message="$message" /> @enderror
                </div>
                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </div>
</div>
@endsection