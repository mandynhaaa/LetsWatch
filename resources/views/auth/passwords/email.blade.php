@extends('layouts.app')

@section('content')
<div class="container-center">
    <div class="panel">
        <h1 class="title">Redefinir Senha</h1>
        @if (session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 8px;">
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">
                Enviar Link de Redefinição
            </button>
        </form>
    </div>
</div>
@endsection