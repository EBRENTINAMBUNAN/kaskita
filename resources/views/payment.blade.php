<x-header>PAYMENT</x-header>

<!-- Konten utama -->
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Payment Summary</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Hello <span class="font-medium">{{ $users->username }}</span>, here is your billing information.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
                <!-- Menampilkan Total Amount -->
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Total Amount</span>
                    <span class="text-xl font-bold text-green-600">Rp 5.000</span>
                </div>

                <!-- QRIS Image -->
                <div class="mt-6 text-center">
                    <img id="qrisImage" src="https://brenpedia.com/storage/assets/img/uploads/admin/1725739526.jpg"
                        alt="QRIS" class="mx-auto h-32 w-32 object-cover cursor-pointer">
                    <p class="text-sm text-gray-500 mt-2">Klik QRIS untuk memperbesar</p>
                </div>

                <form method="post" action="">
                    @csrf <!-- Pastikan untuk menambahkan token CSRF -->

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex items-center cursor-pointer" onclick="showDetailsCard()">
                                {{-- Input untuk menampung nilai yang dipilih --}}
                                <input type="text" id="selectedValue" name="selectedValue"
                                    class="mt-6 hover:border-hidden focus:outline-none focus:border-transparent w-full"
                                    placeholder="Pilih Pekan Pembayaran" readonly required>
                            </div>
                        </div>
                    </div>

                    <div id="detailsCard"
                        class="bg-white p-6 rounded-lg shadow-lg hidden max-w-md max-h-64 overflow-y-auto mt-4">
                        <div class="grid grid-cols-1 gap-4">
                            @for ($i = 1; $i <= 16; $i++)
                                @if ($users->{'p' . $i} != 1)
                                    <div class="flex items-center cursor-pointer"
                                        onclick="setValue('p{{ $i }}: {{ $users->{'p' . $i} }}')">
                                        <span class="text-sm text-gray-700">Pekan {{ $i }}:
                                            @if ($users->{'p' . $i} == 0)
                                                unpaid
                                            @else
                                                {{ $users->{'p' . $i} }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            @endfor

                        </div>
                    </div>



                    {{-- Upload Payment Proof --}}
                    <div class="mt-6">
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700">Upload Payment
                            Proof</label>
                        <input type="file" name="payment_proof" id="payment_proof"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Tombol Bayar --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Confirm Payment
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="qrisModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden">
    <div class="bg-white p-4 rounded-lg max-w-lg relative flex flex-col items-center">
        <span id="closeModal"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 cursor-pointer text-2xl">&times;</span>
        <img src="https://brenpedia.com/storage/assets/img/uploads/admin/1725739526.jpg" alt="QRIS" class="w-full">
    </div>
</div>

<!-- JavaScript -->
<script>
    // Get elements
    const qrisImage = document.getElementById('qrisImage');
    const qrisModal = document.getElementById('qrisModal');
    const closeModal = document.getElementById('closeModal');

    // Open modal when the QRIS image is clicked
    qrisImage.addEventListener('click', function() {
        qrisModal.classList.remove('hidden'); // Tampilkan modal
        qrisModal.classList.add('flex'); // Aktifkan flex untuk layout modal
    });

    // Close modal when the close button is clicked
    closeModal.addEventListener('click', function() {
        qrisModal.classList.add('hidden'); // Sembunyikan modal
        qrisModal.classList.remove('flex'); // Hapus flex
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target == qrisModal) {
            qrisModal.classList.add('hidden'); // Sembunyikan modal
            qrisModal.classList.remove('flex'); // Hapus flex
        }
    });

    function showDetailsCard() {
        const detailsCard = document.getElementById('detailsCard');
        detailsCard.classList.toggle('hidden'); // Toggle visibility of details card
    }

    function setValue(value) {
        // Ambil hanya bagian yang relevan dari string, misalnya "Pekan 15"
        const pekanValue = value.split(':')[0]; // Mengambil bagian sebelum ":" saja
        document.getElementById('selectedValue').value = pekanValue; // Set nilai ke input
        document.getElementById('detailsCard').classList.add('hidden'); // Sembunyikan card
    }
</script>


<x-footer></x-footer>
