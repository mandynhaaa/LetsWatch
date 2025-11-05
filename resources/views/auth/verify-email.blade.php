<h1>Verifique seu e-mail</h1>
<p>
    Antes de continuar, por favor, verifique seu e-mail para um link de verificação.
    Se você não recebeu o e-mail,
    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">clique aqui para solicitar outro</button>.
    </form>
</p>