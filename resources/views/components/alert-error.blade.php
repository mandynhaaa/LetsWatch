@props(['message'])

@if($message)
<br>
<br>
<div {{ $attributes->merge(['class' => 'flex items-center gap-3 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 font-medium text-sm mt-1 shadow-sm']) }}>
    <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
    </svg>
    
    <span>{{ $message }}</span>
</div>
@endif