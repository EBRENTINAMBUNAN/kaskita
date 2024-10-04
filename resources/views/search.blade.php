<x-header>SEARCHPAGE</x-header>

<x-sidebar></x-sidebar>

{{-- content --}}
<div class="container mx-auto p-4">
    <div class="flex justify-center mb-6">
        <input type="text"
            class="border border-gray-300 rounded-lg px-4 py-2 w-full max-w-lg focus:outline-none focus:ring focus:border-blue-300"
            placeholder="Ketik NIM kamu..." />
        <button class="bg-blue-500 text-white px-4 py-2 ml-2 rounded-lg hover:bg-blue-600">Cari</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Card Example -->
        <div
            class="bg-gradient-to-r from-blue-100 via-white to-blue-100 shadow-lg rounded-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <span class="text-sm text-gray-500">Date</span>
                    <p class="text-xl font-semibold text-gray-800">2024-09-30 10:51:20</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Username</span>
                    <p class="text-xl font-semibold text-gray-800">Jhon Doe</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600 font-medium">Pay: <span class="text-gray-800">Online</span></p>
                </div>
            </div>

            <div class="flex justify-between items-center py-4 px-6 bg-blue-50 rounded-lg">
                <div>
                    <p class="text-gray-600 font-medium">Periode</p>
                    <p class="text-xl font-semibold text-gray-800">1</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Amount</p>
                    <p class="text-2xl font-bold text-green-600">+ Rp 5.000</p>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end content --}}

<x-footer></x-footer>
