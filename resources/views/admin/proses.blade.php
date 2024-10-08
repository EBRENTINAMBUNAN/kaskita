<x-admin.header>PROSES KAS</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                <tr>
                    <th class="py-2 px-3">No</th>
                    <th class="py-2 px-3">Nama</th>
                    <th class="py-3 px-6">Waktu Pembayaran</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($items as $index => $item)
                    <tr onclick="openDetailModal('{{ $item->id }}', '{{ $item->username }}', '{{ $item->pekan }}', '{{ $item->amount }}', '{{ $item->image }}')"
                        class="cursor-pointer hover:bg-gray-100 transition duration-300">
                        <td class="py-2 px-3 text-center">{{ $index + 1 }}</td>
                        <td class="py-2 px-3 text-center uppercase">{{ $item->username }} - {{ $item->nim }}</td>
                        <td class="py-2 px-3 text-center uppercase">{{ $item->created_at }} <p>klik untuk detail
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="detailModal"
        class="fixed inset-0 flex items-center justify-center z-80 opacity-0 invisible transition-opacity duration-300 ease-out bg-black bg-opacity-50">
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-lg h-5/6 overflow-auto">
            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-blue-700">Detail Pembayaran</h2>
                <button id="closeModalBtn"
                    class="text-gray-400 hover:text-red-600 transition duration-200 text-3xl font-bold">
                    &times;
                </button>
            </div>
            <div class="mt-6 space-y-6">
                <!-- Username -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-lg border-l-4 border-blue-500">
                    <p class="text-gray-800 font-medium text-lg">
                        <strong class="block text-blue-600">Username:</strong>
                        <span id="modalUsername" class="uppercase block text-xl mt-1"></span>
                    </p>
                </div>
                <!-- Pekan -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-lg border-l-4 border-green-500">
                    <p class="text-gray-800 font-medium text-lg">
                        <strong class="block text-green-600">Pekan:</strong>
                        <span id="modalPekan" class="block text-xl mt-1"></span>
                    </p>
                </div>
                <!-- Amount -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-lg border-l-4 border-yellow-500">
                    <p class="text-gray-800 font-medium text-lg">
                        <strong class="block text-yellow-600">Amount:</strong>
                        <span id="modalAmount" class="block text-xl mt-1"></span>
                    </p>
                </div>
                <!-- Image Preview -->
                <div class="rounded-lg overflow-hidden">
                    <img id="modalImagePreview" src="" alt="Bukti Pembayaran"
                        class="w-full h-auto rounded-md shadow-lg transform transition-transform duration-300 hover:scale-105">
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <!-- Tombol Terima -->
                <button id="acceptButton"
                    class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-green-300">
                    <i class="fas fa-check-circle mr-2"></i> Terima
                </button>

                <!-- Tombol Tolak -->
                <button id="rejectButton"
                    class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-red-300">
                    <i class="fas fa-times-circle mr-2"></i> Tolak
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Terima -->
    <div id="modalTerima"
        class="fixed inset-0 flex items-center justify-center z-90 opacity-0 invisible transition-opacity duration-300 ease-out bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <div class="flex justify-between items-center border-b border-gray-300 pb-2">
                <h2 class="text-2xl font-bold text-green-600">Konfirmasi Terima</h2>
            </div>
            <div class="mt-4">
                <p>Apakah Anda yakin ingin menerima pembayaran ini?</p>
            </div>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="confirmAcceptButton"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                    Lanjutkan
                </button>
                <button id="cancelAcceptButton"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Tolak -->
    <div id="modalTolak"
        class="fixed inset-0 flex items-center justify-center z-90 opacity-0 invisible transition-opacity duration-300 ease-out bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <div class="flex justify-between items-center border-b border-gray-300 pb-2">
                <h2 class="text-2xl font-bold text-red-600">Konfirmasi Tolak</h2>
            </div>
            <div class="mt-4">
                <p>Apakah Anda yakin ingin menolak pembayaran ini?</p>
            </div>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="confirmRejectButton"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-300">
                    Lanjutkan
                </button>
                <button id="cancelRejectButton"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Error -->
    <div id="errorModal"
        class="fixed inset-0 flex items-center justify-center z-100 opacity-0 invisible transition-opacity duration-300 ease-out bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <div class="flex justify-between items-center border-b border-gray-300 pb-2">
                <h2 class="text-2xl font-bold text-red-600">Error</h2>
                <button id="closeErrorModalBtn" class="text-gray-500 hover:text-gray-800 transition duration-200">
                    &times;
                </button>
            </div>
            <div class="mt-4">
                <p id="errorMessage" class="text-red-500 text-lg"></p> <!-- Tempat untuk pesan error -->
            </div>
            <div class="mt-4 flex justify-end">
                <button id="closeErrorModal"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/admin.proses.js') }}"></script>




    <x-admin.footer></x-admin.footer>
