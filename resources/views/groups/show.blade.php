@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#000000] text-[#f4f4f4] px-4 py-6 sm:px-6 lg:px-10">
    <div class="mx-auto grid w-full max-w-[1400px] grid-cols-1 gap-6 lg:grid-cols-[1fr_320px]">
        <main class="rounded-2xl border border-[#2a2a2a] bg-[#101010] p-5 shadow-[0_14px_35px_rgba(0,0,0,0.6)]">
            <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-3xl font-black tracking-wide text-white">{{ $group->name }}</h1>
                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-lg border border-[#2a2a2a] p-2">
                        <span class="text-sm text-gray-400">Código de Convite:</span>
                        <span id="invite-code" class="rounded-md border border-[#2a2a2a] px-2 py-1 text-sm font-semibold text-[#f4f4f4]">{{ $group->invite_code }}</span>
                        <button id="copy-invite" class="inline-flex items-center gap-1 rounded-md border border-[#2a2a2a] px-2 py-1 text-xs font-bold text-[#f4f4f4] transition hover:bg-[#2a2a2a]" type="button">Copiar</button>
                    </div>
                </div>
            </div>

            <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold text-white">Filmes em Comum</h2>
                @if (count($moviesDetails) > 0)
                    <p class="text-sm text-gray-400">Total: {{ count($moviesDetails) }}</p>
                @endif
            </div>

            @if (count($moviesDetails) > 0)
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($moviesDetails as $movie)
                        <article class="overflow-hidden rounded-xl border border-[#2a2a2a] bg-[#1a1a1a] transition hover:-translate-y-1 hover:shadow-2xl">
                            <a href="{{ route('groups.feedback.create', ['group' => $group->id, 'tmdbMovieId' => $movie['id']]) }}" class="block">
                                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="h-[320px] w-full object-cover" loading="lazy">
                                <div class="px-3 py-3">
                                    <h3 class="text-lg font-semibold text-white">{{ $movie['title'] }}</h3>
                                    <p class="mt-1 text-sm text-gray-400">{{ $movie['genres'] }}</p>
                                    <div class="mt-2 flex items-center justify-between text-sm text-gray-300">
                                        <span>Lançamento: {{ $movie['release_date'] }}</span>
                                        <span class="inline-flex items-center gap-1 font-bold text-amber-400">
                                            <svg class="w-4 h-4 text-yellow-500" 
                                                viewBox="0 0 20 20" 
                                                fill="currentColor" 
                                                aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg> 
                                            {{ $movie['vote_average'] }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="rounded-lg border border-gray-700 bg-gray-900/60 p-4 text-gray-300">Nenhum filme curtido ainda.</p>
            @endif
        </main>

        <aside class="sticky top-6 self-start rounded-2xl border border-[#2a2a2a] bg-[#101010] p-5 shadow-xl">
            <h3 class="mb-3 text-lg font-semibold text-[#f4f4f4]">Membros do Grupo</h3>
            <ul class="space-y-2">
                @foreach ($group->members as $member)
                    <li class="flex items-center justify-between rounded-lg border border-[#2a2a2a] bg-[#101010] px-3 py-2 text-sm">
                        <span class="truncate">{{ $member->name }}</span>
                        @if ($member->id === $group->created_by_user_id)
                            <span class="rounded-full bg-red-500 px-2 py-1 text-xs font-bold text-white">Criador</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>
@endsection
@push('scripts')
    @vite('resources/js/copy.js')
@endpush