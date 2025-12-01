@extends('layouts.app')

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Definir Nova Senha</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input id="password" type="password" name="password" required style="width: 100%; padding: 8px;">
                @error('password')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha:</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required style="width: 100%; padding: 8px;">
            </div>
            <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Redefinir Senha
            </button>
        </form>
    </div>
</div>