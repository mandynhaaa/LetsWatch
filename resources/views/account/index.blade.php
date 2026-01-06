@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Configurações da Conta</h1>
        @if (session('success'))
            <p class="sucess">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input id="password" type="password" name="password">
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
                @error('password_confirmation') <span>{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn">
                Atualizar Dados
            </button>
        </form>
        <hr
        <h1 class="title">Sair da Conta</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn">Deslogar</button>
        </form>
    </div>
</div>
@endsection