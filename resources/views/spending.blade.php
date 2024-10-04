<x-header>SPENDINGPAGE</x-header>

<x-sidebar></x-sidebar>

{{-- content --}}
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Cash Spending Overview</h2>

    <!-- Riwayat Pengeluaran Kas - Card 1 -->
    <div
        class="bg-white shadow-xl rounded-xl border border-gray-200 p-6 mb-6 transition-transform transform hover:scale-105 hover:bg-red-50 hover:shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M17.5 15a1 1 0 01-1 1h-13a1 1 0 010-2h13a1 1 0 011 1z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <span class="text-sm text-gray-500">Date</span>
                    <p class="text-xl font-semibold text-gray-800">2024-09-30 10:00</p>
                </div>
            </div>
            <div>
                <p class="text-lg font-bold text-red-600">Rp 50.000</p>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <p class="text-gray-600 font-medium">Pembelian sapu untuk kebersihan kantor</p>
        </div>
    </div>

    <!-- Riwayat Pengeluaran Kas - Card 2 -->
    <div
        class="bg-white shadow-xl rounded-xl border border-gray-200 p-6 mb-6 transition-transform transform hover:scale-105 hover:bg-red-50 hover:shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M17.5 15a1 1 0 01-1 1h-13a1 1 0 010-2h13a1 1 0 011 1z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <span class="text-sm text-gray-500">Date</span>
                    <p class="text-xl font-semibold text-gray-800">2024-09-30 12:00</p>
                </div>
            </div>
            <div>
                <p class="text-lg font-bold text-red-600">Rp 150.000</p>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <p class="text-gray-600 font-medium">Pembayaran listrik bulanan kantor</p>
        </div>
    </div>

    <!-- Riwayat Pengeluaran Kas - Card 3 -->
    <div
        class="bg-white shadow-xl rounded-xl border border-gray-200 p-6 mb-6 transition-transform transform hover:scale-105 hover:bg-red-50 hover:shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M17.5 15a1 1 0 01-1 1h-13a1 1 0 010-2h13a1 1 0 011 1z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <span class="text-sm text-gray-500">Date</span>
                    <p class="text-xl font-semibold text-gray-800">2024-09-30 15:30</p>
                </div>
            </div>
            <div>
                <p class="text-lg font-bold text-red-600">Rp 25.000</p>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <p class="text-gray-600 font-medium">Pembelian alat tulis untuk administrasi</p>
        </div>
    </div>
</div>
{{-- end content --}}

<x-footer></x-footer>
