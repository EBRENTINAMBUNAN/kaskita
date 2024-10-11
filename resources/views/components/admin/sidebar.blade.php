<!-- Header Section -->
<header class="md:hidden bg-blue-600 py-6">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <!-- App Name (Center aligned for both mobile and desktop) -->
        <div class="md:hidden text-white text-3xl font-bold ml-2">
            {{ config('app.name') }}
        </div>

        <!-- Hamburger Icon for Mobile (Right) -->
        <button @click="sidebarOpen = !sidebarOpen" class="text-white block md:hidden focus:outline-none"
            aria-label="Open Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</header>


<!-- Sidebar for Mobile (Right) -->
<div class="md:hidden">
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
            <a href="/admin/"
                class="flex items-center space-x-4 text-xl {{ request()->is('admin') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('readMember') }}"
                class="flex items-center space-x-4 text-xl {{ request()->is('admin/member') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                <i class="fas fa-user"></i>
                <span>member</span>
            </a>
            <a href="{{ route('index.qris') }}"
                class="flex items-center space-x-4 text-xl {{ request()->is('admin/qris') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                <i class="fas fa-qrcode"></i>
                <span>QRIS</span>
            </a>
            <a href="/admin/pengaturan"
                class="flex items-center space-x-4 text-xl {{ request()->is('admin/pengaturan') ? 'bg-blue-700' : 'text-gray-300' }} hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <a href="/auth/logout"
                class="flex items-center space-x-4 text-xl hover:bg-blue-700 hover:bg-opacity-50 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </a>
        </div>

        <div class="mt-20">
            <p class="text-center text-sm text-gray-300">Kaskita v1.0</p>
        </div>
    </div>
</div>


<div class="flex h-screen">
    <!-- Sidebar -->
    <div
        class="bg-blue-700 text-white w-64 flex-col justify-between shadow-xl hidden md:flex hover:bg-gradient-to-t hover:from-blue-500 hover:to-blue-800">
        <div class="flex flex-col space-y-6 py-6">
            <div class="text-center text-3xl font-bold tracking-wide">
                {{ config('app.name') }}
            </div>
            <!-- Navigation Links -->

            <a href="/admin/"
                class="flex items-center px-6 py-4 {{ request()->is('admin') ? 'bg-blue-600' : '' }} rounded-lg hover:bg-blue-500 transition ease-in-out duration-300">
                <i class="fas fa-home mr-3 text-lg"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('readMember') }}"
                class="flex items-center px-6 py-4 {{ request()->is('admin/member') ? 'bg-blue-600' : '' }} hover:bg-blue-500 rounded-lg transition ease-in-out duration-300">
                <i class="fas fa-user mr-3 text-lg"></i>
                <span>member</span>
            </a>
            <a href="{{ route('index.qris') }}"
                class="flex items-center px-6 py-4 {{ request()->is('admin/qris') ? 'bg-blue-600' : '' }} hover:bg-blue-500 rounded-lg transition ease-in-out duration-300">
                <i class="fas fa-qrcode mr-3 font-bold text-lg"></i>
                <span>QRIS</span>
            </a>
            <a href="/admin/pengaturan"
                class="flex items-center px-6 py-4 {{ request()->is('admin/pengaturan') ? 'bg-blue-600' : '' }} hover:bg-blue-500 rounded-lg transition ease-in-out duration-300">
                <i class="fas fa-cog mr-3 text-lg"></i>
                <span>Pengaturan</span>
            </a>
            <a href="/auth/logout"
                class="flex items-center px-6 py-4 hover:bg-blue-500 rounded-lg transition ease-in-out duration-300">
                <i class="fas fa-sign-out-alt mr-3 text-lg"></i>
                <span>Keluar</span>
            </a>
        </div>
        <div class="text-center py-4">
            <p class="text-sm text-gray-300 hover:text-gray-100 transition-colors">KasKita v1.0</p>
        </div>
    </div>
