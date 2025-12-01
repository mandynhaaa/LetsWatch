
<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h1>Definir Nova Senha</h1>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
        <div style="margin-bottom: 15px;">
            <label for="password">Nova Senha:</label>
            <input id="password" type="password" name="password" required style="width: 100%; padding: 8px;">
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Redefinir Senha
        </button>
    </form>
</div>