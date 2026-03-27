@extends('layouts.app')
@section('content')
<div class="container-center">
    <div class="panel">
        <img src="{{ asset('images/logo.png') }}" alt="LetsWatch Logo" class="logo">
         <br>
        <h1 class="title">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" required>
                <a href="{{ route('password.request') }}" class="text-red-500">
                    Esqueceu sua senha?
                </a>
                @error('error') <x-alert-error :message="$message" /> @enderror
            </div>
            <div class="flex items-center justify-start gap-2 text-gray-300 mb-4">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-red-500 focus:ring-red-400 rounded border-gray-300 bg-gray-800" />
                <label for="remember" class="text-sm font-medium leading-none">Lembrar-me</label>
            </div>
            <div class="flex flex-col gap-4">
                <button type="submit" class="btn">
                    Entrar
                </button>
                <div class="btn-secondary">
                    <a href="{{ route('register') }}">
                        Criar conta
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection