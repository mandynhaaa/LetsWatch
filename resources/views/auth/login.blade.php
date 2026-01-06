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
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" required>
                <a href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            </div>
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Lembrar-me</label>
            </div>
            <button type="submit" class="btn">
                Entrar
            </button>
            <div>
                <a href="{{ route('register') }}">
                    Criar conta
                </a>
            </div>
        </form>
    </div>
</div>
@endsection