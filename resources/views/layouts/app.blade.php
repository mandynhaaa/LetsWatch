<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/logoicon.png">
    <title>@yield('title', 'Let\'s Watch')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/cards.js'])
    @stack('scripts')
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)]">
    <div id="app" class="min-h-screen">
        <header>
            @yield('nav')
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
