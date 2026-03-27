@props(['message'])

@if($message)
<div {{ $attributes->merge(['class' => 'flex items-center gap-3 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-medium text-sm mt-1 shadow-sm']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    
    <span>{{ $message }}</span>
</div>
@endif