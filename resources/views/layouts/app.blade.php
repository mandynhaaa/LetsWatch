<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LetsWatch')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="height: 100%; margin: 0;">
    <div id="app" style="height: 100%;">
        @includeIf('components.nav')
        <main class="py-4" style="height: 100%;">
            @yield('content')
        </main>
    </div>
</body>
</html>
