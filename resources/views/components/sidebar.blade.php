<!-- Header Section -->
<header class="bg-blue-600 py-6">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <div class="text-white text-3xl font-bold">
            {{ config('app.name') }}
        </div>

        <div class="hidden md:block">
            <a href="/" class="ml-8 {{ request()->is('/') ? 'text-white' : 'text-gray-400' }} hover:text-white">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="/saving"
                class="ml-8 {{ request()->is('saving') ? 'text-white' : 'text-gray-400' }} hover:text-white">
                <i class="fas fa-wallet"></i>
                <span>Saving</span>
            </a>
            <a href="/spending"
                class="ml-8 {{ request()->is('spending') ? 'text-white' : 'text-gray-400' }} hover:text-white">
                <i class="fas fa-chart-line"></i>
                <span>Spending</span>
            </a>
            <a href="/search"
                class="ml-8 {{ request()->is('search') ? 'text-white' : 'text-gray-400' }} hover:text-white">
                <i class="fas fa-search"></i>
                <span>Search</span>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button @click="sidebarOpen = true" class="text-white block md:hidden focus:outline-none"
            aria-label="Open Menu">
            <!-- Hamburger Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</header>

<!-- Sidebar (Mobile) -->
<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-gray-800 bg-opacity-75 z-40"
    @click="sidebarOpen = false"></div>
<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed inset-y-0 right-0 bg-gradient-to-b from-blue-600 to-blue-500 text-white w-2/3 max-w-xs z-50 transform shadow-lg rounded-l-lg">
    <div class="flex flex-col p-6 space-y-8">
        <!-- Close Button -->
        <div class="flex justify-end">
            <button @click="sidebarOpen = false" class="text-white">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <a href="/"
            class="flex items-center space-x-4 text-xl {{ request()->is('/') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="/saving"
            class="flex items-center space-x-4 text-xl {{ request()->is('saving') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-wallet"></i>
            <span>Saving</span>
        </a>
        <a href="/spending"
            class="flex items-center space-x-4 text-xl {{ request()->is('spending') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-chart-line"></i>
            <span>Spending</span>
        </a>
        <a href="/search"
            class="flex items-center space-x-4 text-xl {{ request()->is('search') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-search"></i>
            <span>Search</span>
        </a>
    </div>
    <div class="mt-20">
        <p class="text-center text-sm text-gray-300">Kaskita v1.0</p>
    </div>
</div>
