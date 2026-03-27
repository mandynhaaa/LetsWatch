@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Configurações da Conta</h1>
        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input id="password" type="password" name="password">
                @error('password') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
                @error('password_confirmation') <x-alert-error :message="$message" /> @enderror
            </div>            
            <div class="flex flex-col gap-4 mt-4">
                <button type="submit" class="btn">
                    Atualizar Dados
                </button>
            </div>
        </form>
        <div class="flex flex-col gap-4 mt-4">
            <hr>
            <h1 class="title-secondary">Sair da Conta</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn">Deslogar</button>
            </form>
        </div>
    </div>
</div>
@endsection