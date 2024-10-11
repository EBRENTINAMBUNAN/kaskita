<x-admin.header>Dashboard</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">Total Kas</h3>
                    <p class="text-3xl font-bold text-green-600">Rp <br> {{ number_format($hasilKas, 0, ',', '.') }}</p>
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
                        <p class="text-3xl font-bold text-blue-600">Rp <br> {{ number_format($payments, 0, ',', '.') }}
                        </p>
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
                        <p class="text-3xl font-bold text-red-600">Rp <br>
                            {{ number_format($totalSpending, 0, ',', '.') }}
                        </p>
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
            <h3 class="text-lg font-semibold mb-4">Riwayat Pemasukan Terbaru</h3>
            <ul>
                @foreach ($historys as $item)
                    <li class="flex justify-between mb-4">
                        <div>
                            <p class="text-xs text-gray-500">pembayaran {{ $item->status }}</p>
                            <p class="text-sm font-semibold text-gray-600">{{ $item->username }}</p>
                            <p class="text-xs text-gray-500">{{ $item->created_at }}</p>
                        </div>
                        <div>
                            @php
                                $pekanArray = explode(', ', $item->pekan);

                                $pekanArray = array_map(function ($pekan) {
                                    return trim($pekan);
                                }, $pekanArray);

                                if (count($pekanArray) > 1) {
                                    $minPekan =
                                        'P' .
                                        min(
                                            array_map(function ($pekan) {
                                                return intval(str_replace('P', '', $pekan));
                                            }, $pekanArray),
                                        );

                                    $maxPekan =
                                        'P' .
                                        max(
                                            array_map(function ($pekan) {
                                                return intval(str_replace('P', '', $pekan));
                                            }, $pekanArray),
                                        );
                                } else {
                                    $minPekan = $pekanArray[0];
                                    $maxPekan = null;
                                }
                            @endphp

                            <p class="text-sm font-semibold">
                                @if ($maxPekan)
                                    {{ $minPekan . ' - ' . $maxPekan }}
                                @else
                                    {{ $minPekan }}
                                @endif
                            </p>



                            <p class="text-sm font-semibold text-green-600">+ Rp
                                {{ number_format($item->amount, 0, ',', '.') }}</p>
                        </div>
                    </li>
                    <hr>
                @endforeach
            </ul>
            <div class="text-right">
                <a href="#" class="text-blue-500 hover:underline text-sm">Lihat Semua</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Riwayat Pengeluaran Terbaru</h3>
            <ul>
                @foreach ($hispends as $item)
                    <li class="flex justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-600">{{ $item->deskripsi }}</p>
                            <p class="text-xs text-gray-500">{{ $item->created_at }}</p>
                        </div>
                        <p class="text-sm font-semibold text-red-600">- Rp
                            {{ number_format($item->amount, 0, ',', '.') }}</p>
                    </li>
                    <br>
                @endforeach
            </ul>
            <div class="text-right">
                <a href="#" class="text-blue-500 hover:underline text-sm">Lihat Semua</a>
            </div>
        </div>
    </div>
</div>
</div>

<x-admin.footer></x-admin.footer>
