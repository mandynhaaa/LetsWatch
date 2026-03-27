<nav class="relative z-50 bg-opacity-95 border-b border-gray-800 px-8 py-4 flex items-center justify-between">
    <div class="flex-shrink-0">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Lets Watch" class="h-10">
        </a>
    </div>
    <ul class="hidden md:flex list-none gap-8 m-0 p-0 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
        <li><a href="/home" class="text-gray-300 hover:text-red-600 font-medium transition-colors duration-300">Início</a></li>
        <li><a href="/groups" class="text-gray-300 hover:text-red-600 font-medium transition-colors duration-300">Grupos</a></li>
        <li><a href="/account" class="text-gray-300 hover:text-red-600 font-medium transition-colors duration-300">Conta</a></li>
    </ul>
</nav>