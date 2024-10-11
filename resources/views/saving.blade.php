<x-header>SAVINGPAGE</x-header>
<x-sidebar></x-sidebar>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-center text-gray-900 mb-2">Riwayat Pemasukan</h2>
    <p class="text-center text-gray-700 mb-4">Kamu dapat melihat seluruh riwayat
        pembayaran
        terbaru secara real time.</p>

    @foreach ($payments as $item)
        <div
            class="bg-gradient-to-r from-blue-100 via-white to-blue-100 shadow-lg rounded-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <span class="text-sm text-gray-500">{{ $item->created_at }}</span>
                </div>
                <div>
                    <p class="text-xl font-semibold text-gray-800">{{ $item->username }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600 font-medium">Pay: <span class="text-gray-800">{{ $item->type }}</span>
                    </p>
                    <p class="text-gray-600 font-medium">Status: <span class="text-gray-800">{{ $item->status }}</span>
                    </p>
                </div>
            </div>

            <div class="flex justify-between items-center py-4 px-6 bg-blue-50 rounded-lg">
                <div>
                    <p class="text-gray-600 font-medium">Periode</p>
                    <p class="text-xl font-semibold text-gray-800">{{ $item->pekan }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Amount</p>
                    <p class="text-2xl font-bold text-green-600">+ Rp {{ number_format($item->amount, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
