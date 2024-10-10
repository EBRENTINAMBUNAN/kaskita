<x-header>SPENDINGPAGE</x-header>

<x-sidebar></x-sidebar>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Cash Spending Overview</h2>
    @foreach ($spendings as $item)
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
                        <p class="text-xl font-semibold text-gray-800">{{ $item->created_at }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-lg font-bold text-red-600">- Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <p class="text-gray-600 font-medium">{!! nl2br(e($item->deskripsi)) !!}</p>
            </div>
        </div>
    @endforeach
</div>
<x-footer></x-footer>
