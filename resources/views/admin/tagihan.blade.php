<x-admin.header>Tagihan Page</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">
    <div class="container mx-auto">
        <!-- Heading dengan Icon -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-500 text-white p-2 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-700">Daftar Tagihan Pembayaran</h2>
            </div>
            <button
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 hover:scale-105 transform transition-all duration-300 ease-in-out">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Tagihan
            </button>
        </div>

        <!-- Membungkus tabel untuk overflow di mobile -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-5 text-left">Nama</th>
                            <th class="py-3 px-5 text-left">NIM</th>
                            <th class="py-3 px-5 text-left">Pekan 1</th>
                            <th class="py-3 px-5 text-left">Pekan 2</th>
                            <th class="py-3 px-5 text-left">Pekan 3</th>
                            <th class="py-3 px-5 text-left">Pekan 4</th>
                            <th class="py-3 px-5 text-left">Pekan 5</th>
                            <th class="py-3 px-5 text-left">Pekan 6</th>
                            <th class="py-3 px-5 text-left">Pekan 7</th>
                            <th class="py-3 px-5 text-left">Pekan 8</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-5">Jack</td>
                            <td class="py-3 px-5">2305</td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-5">John</td>
                            <td class="py-3 px-5">2304</td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-5">Jess</td>
                            <td class="py-3 px-5">2303</td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Unpaid</span>
                            </td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-5">Cika</td>
                            <td class="py-3 px-5">2302</td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Unpaid</span>
                            </td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-5">Viktor</td>
                            <td class="py-3 px-5">2301</td>
                            <td class="py-3 px-5">
                                <span
                                    class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                            <td class="py-3 px-5"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Muat Lebih Banyak -->
        <div class="mt-6 text-right">
            <button
                class="bg-gray-200 text-gray-600 px-4 py-2 rounded-lg shadow-lg hover:bg-gray-300 hover:scale-105 transform transition-all duration-300 ease-in-out">
                Muat Lebih Banyak
            </button>
        </div>
    </div>
</div>

<x-admin.footer></x-admin.footer>
