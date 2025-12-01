@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
    <h1>Configurações da Conta</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('account.update') }}" style="max-width: 400px; margin-top: 20px;">
        @csrf
        <div>
            <label for="name">Nome:</label>
            <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            @error('name') <span>{{ $message }}</span> @enderror
        </div>
        <div style="margin-top: 15px;">
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>
        <div style="margin-top: 15px;">
            <label for="password">Nova Senha</label>
            <input id="password" type="password" name="password">
            @error('password') <span>{{ $message }}</span> @enderror
        </div>
        <div style="margin-top: 15px;">
            <label for="password_confirmation">Confirmar Nova Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
            @error('password_confirmation') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit" style="margin-top: 20px; padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
            Atualizar Dados
        </button>
    </form>
    <hr style="margin: 30px 0;">
    <h2>Sair da Conta</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="padding: 10px 15px; background-color: #dc3545; color: white; border: none; border-radius: 5px;">
            Deslogar
        </button>
    </form>
@endsection