@extends('layouts.app')

@section('nav')
    @includeIf('components.nav')
@endsection

@section('content')
<div class="min-h-screen bg-black text-white p-6 sm:p-12">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight">Meus Grupos</h1>
            <p class="text-neutral-500 text-sm mt-1">Gerencie seus grupos e acompanhe os feedbacks.</p>
        </div>
        
        <a href="{{ route('groups.create') }}" 
           class="w-full sm:w-auto bg-[#e31818] hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2 shadow-lg shadow-red-900/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Novo Grupo
        </a>
    </div>

    <div class="max-w-6xl mx-auto">
        @if ($allGroups->count() > 0)
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($allGroups as $group)
                    <li class="relative group">
                        <a href="{{ route('groups.show', $group) }}" 
                           class="block h-full bg-[#121212] border border-neutral-800 rounded-2xl p-6 transition duration-300 hover:border-neutral-600 hover:bg-[#161616] shadow-sm hover:shadow-xl">
                            
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-neutral-800 rounded-xl flex items-center justify-center group-hover:bg-[#e31818] transition-colors duration-300">
                                    <span class="text-xl font-bold">{{ substr($group->name, 0, 1) }}</span>
                                </div>

                                @if ($group->created_by_user_id === Auth::id())
                                    <span class="bg-red-600/10 text-[#e31818] border border-red-600/20 text-[10px] uppercase tracking-widest font-black px-2 py-1 rounded-md">
                                        Criador
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-1">
                                <h3 class="text-xl font-bold group-hover:text-[#e31818] transition-colors">
                                    {{ $group->name }}
                                </h3>
                                <p class="text-neutral-500 text-sm flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    Membros: {{ $group->members->count() }}
                                </p>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <span class="text-[#e31818] opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1 text-sm font-bold">
                                    Acessar grupo 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-center py-24 bg-[#121212] border border-dashed border-neutral-800 rounded-3xl mt-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-neutral-900 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white">Nenhum grupo encontrado</h3>
                <p class="text-neutral-500 mt-2 max-w-xs mx-auto">
                    Você ainda não pertence a nenhum grupo. Crie um novo ou entre usando um código de convite!
                </p>
                <div class="mt-8">
                    <a href="{{ route('groups.create') }}" class="text-[#e31818] font-bold hover:underline">
                        Comece criando um grupo agora &rarr;
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection