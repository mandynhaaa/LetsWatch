@extends('layouts.app')

@section('content')
<div class="container-center">
    <div class="panel">
        <img src="/images/logo.png" alt="Let's Watch" class="logo">
        <p class="text-white text-[1.15rem] font-medium mb-7">
            Escolher um filme nunca foi tão fácil.
        </p>
        <div class="flex flex-col gap-4">
            <a href="/login" class="btn">
                Login
            </a>
            <a href="/register" class="btn">
                Criar Conta
            </a>
        </div>
    </div>
</div>
@endsection