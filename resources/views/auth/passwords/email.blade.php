<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h1>Redefinir Senha</h1>
    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="email">Endereço de E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 8px;">
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Enviar Link de Redefinição
        </button>
    </form>
</div>