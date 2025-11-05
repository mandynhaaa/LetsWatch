<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Lembrar-me</label>
    </div>
    <div>
        <button type="submit">Entrar</button>
    </div>
</form>