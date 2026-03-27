@extends('layouts.app')

@section('content')
<div class="container-center">
    <div class="panel">
        <img src="{{ asset('images/logo.png') }}" alt="LetsWatch Logo" class="logo">
        <h1 class="title">Criar Conta</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input id="name" type="text" name="name" required autofocus>
                @error('name') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" required>
                @error('email') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" required>
                @error('password') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="flex flex-col gap-4 mt-4">
                <button type="submit" class="btn">Registrar</button>
                <div class="btn-secondary">
                    <a href="{{ route('login') }}">
                        Retornar ao Login
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection