<nav class="relative z-50 bg-opacity-95 border-b border-gray-800 px-8 py-4">
    <div class="flex items-center justify-between">
        <div class="flex-shrink-0">
            <a href="{{ url('/home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Lets Watch" class="h-10">
            </a>
        </div>
        <button id="menu-btn" class="block sm:hidden text-gray-300 hover:text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <ul id="mobile-menu" 
            class="hidden sm:flex flex-col sm:flex-row list-none m-0 p-0 bg-black sm:bg-transparent
                   absolute left-0 top-full w-full border-t border-gray-800
                   sm:absolute sm:left-1/2 sm:top-1/2 sm:w-auto sm:border-none
                   sm:-translate-x-1/2 sm:-translate-y-1/2 sm:gap-8">
            <li class="border-b border-gray-800 sm:border-none">
                <a href="/home" class="block w-full px-8 py-4 sm:p-0 text-gray-300 hover:text-red-600 font-medium transition-colors hover:bg-gray-900 sm:hover:bg-transparent">
                    Início
                </a>
            </li>
            <li class="border-b border-gray-800 sm:border-none">
                <a href="/groups" class="block w-full px-8 py-4 sm:p-0 text-gray-300 hover:text-red-600 font-medium transition-colors hover:bg-gray-900 sm:hover:bg-transparent">
                    Grupos
                </a>
            </li>
            <li>
                <a href="/account" class="block w-full px-8 py-4 sm:p-0 text-gray-300 hover:text-red-600 font-medium transition-colors hover:bg-gray-900 sm:hover:bg-transparent">
                    Conta
                </a>
            </li>
        </ul>
    </div>
</nav>
@push('scripts')
    @vite('resources/js/nav.js')
@endpush