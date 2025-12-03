@extends('layouts.app')

@section('content')

<div class="container-center">
    <div class="panel">
        <img src="/images/logo.png" alt="Let's Watch" class="logo">
        <p>
            Gerencie seus filmes favoritos de forma<br>
            simples, rápida e divertida.
        </p>
        <div class="flex flex-col gap-4">
            <a href="/login" class="btn-login">Login</a>
            <br>
            <a href="/register" class="btn-login">Criar Conta</a>
        </div>
    </div>
</div>
@endsection