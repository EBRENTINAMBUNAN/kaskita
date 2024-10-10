<x-admin.header>Dashboard</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

{{-- content --}}
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">Total Kas</h3>
                    <p class="text-3xl font-bold text-green-600">Rp <br> {{ number_format($totalKas, 0, ',', '.') }}</p>
                </div>
                <div class="bg-green-500 p-3 rounded-full">
                    <i class="fas fa-wallet text-white"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">total uang kas saat ini</p>
        </div>

        <a href="{{ route('index.manual.proses') }}">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Kas Masuk</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $members->count() }} <br> member</p>
                    </div>
                    <div class="bg-blue-500 p-3 rounded-full">
                        <i class="fas fa-arrow-down text-white"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">klik untuk menambahkan manual</p>
            </div>
        </a>

        <a href="/admin/pengeluaran">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Kas Keluar</h3>
                        <p class="text-3xl font-bold text-red-600">Rp 10,000,000</p>
                    </div>
                    <div class="bg-red-500 p-3 rounded-full">
                        <i class="fas fa-arrow-up text-white"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">klik untuk lihat detail</p>
            </div>
        </a>

        <a href="{{ route('index.proses') }}">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Proses Kas</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $prosesKas->count() }} permintaan</p>
                    </div>
                    <div class="bg-yellow-500 p-3 rounded-full">
                        <i class="fas fa-sync-alt text-white"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">klik untuk memproses permintaan</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Grafik Arus Kas</h3>
            <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                <span class="text-gray-500">Grafik Interaktif Di Sini</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>
            <ul>
                <li class="flex justify-between mb-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Pembelian Barang</p>
                        <p class="text-xs text-gray-500">03/10/2024</p>
                    </div>
                    <p class="text-sm font-semibold text-red-600">- Rp 1,200,000</p>
                </li>
                <li class="flex justify-between mb-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Penjualan Produk</p>
                        <p class="text-xs text-gray-500">02/10/2024</p>
                    </div>
                    <p class="text-sm font-semibold text-green-600">+ Rp 3,400,000</p>
                </li>
                <li class="flex justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Bayar Gaji Karyawan</p>
                        <p class="text-xs text-gray-500">01/10/2024</p>
                    </div>
                    <p class="text-sm font-semibold text-red-600">- Rp 2,500,000</p>
                </li>
            </ul>
            <div class="text-right">
                <a href="#" class="text-blue-500 hover:underline text-sm">Lihat Semua</a>
            </div>
        </div>
    </div>
</div>
</div>
{{-- end content --}}

<x-admin.footer></x-admin.footer>
