@extends('layouts.app')

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Redefinir Senha</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <x-alert-error :message="$message" /> @enderror
            </div>
            <button type="submit" class="btn">
                Enviar Link de Redefinição
            </button>
        </form>
    </div>
</div>
@endsection