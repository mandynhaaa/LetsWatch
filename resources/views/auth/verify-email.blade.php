@extends('layouts.app')

@section('content')

<div class="container-center">
    <div class="panel">
        <img src="{{ asset('images/logo.png') }}" alt="LetsWatch Logo" class="logo">
        <h1 class="title">Verifique seu e-mail</h1>
        <p>
            Antes de continuar, por favor, verifique seu e-mail para o link de verificação.<br>
            Se você não recebeu o e-mail, você pode solicitar outro abaixo.
        </p>
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn">
                Reenviar e-mail de verificação
            </button>
        </form>
        <div>
            <a href="{{ route('login') }}">
                Retornar ao Login
            </a>
        </div>
    </div>
</div>
@endsection