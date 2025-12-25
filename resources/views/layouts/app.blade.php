<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lets Watch') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- 
         Barra de Navegação Padrão 
         (A Home irá ocultar isto usando @section('nav'))
    --}}
    @section('nav')
        @includeIf('components.nav')
    @show

    {{-- Conteúdo das Páginas --}}
    <main>
        @yield('content')
    </main>

    {{-- Scripts Específicos de cada página --}}
    @stack('scripts')
</body>
</html>