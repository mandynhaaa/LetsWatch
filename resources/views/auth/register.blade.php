<h1>Registrar</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="name">Nome</label>
        <input id="name" type="text" name="name" required autofocus>
    </div>
    <div>
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" required>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirmar Senha</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>
    <div>
        <button type="submit">Registrar</button>
    </div>
</form>