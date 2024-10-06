<x-header>PAYMENT</x-header>

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
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Total Amount</span>
                    <span id="totalAmount" class="text-xl font-bold text-green-600">Rp 0</span>
                </div>

                <div class="mt-6 text-center">
                    <img id="qrisImage" src="https://brenpedia.com/storage/assets/img/uploads/admin/1725739526.jpg"
                        alt="QRIS" class="mx-auto h-32 w-32 object-cover cursor-pointer">
                    <p class="text-sm text-gray-500 mt-2">Klik QRIS untuk memperbesar</p>
                </div>

                <form method="post" action="{{ route('payment.proses') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="username" value="{{ $users->username }}">
                    <input type="hidden" name="nim" value="{{ $users->nim }}">
                    <input type="hidden" name="amount" id="amount">

                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between cursor-pointer bg-gray-50 hover:bg-gray-100 p-4 rounded-lg transition duration-150 ease-in-out"
                                onclick="showDetailsCard()">
                                <span id="displaySelectedValue" class="text-lg font-semibold text-gray-800">
                                    Pilih Pekan Pembayaran
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                                <input type="hidden" id="selectedValue" name="pekan">
                            </div>

                            <div id="detailsCard"
                                class="bg-white p-4 rounded-lg shadow-md border border-gray-200 hidden max-h-64 overflow-y-auto">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between cursor-pointer hover:bg-gray-50 p-2 rounded transition"
                                        onclick="selectAllPekan()">
                                        <span class="text-sm font-medium text-gray-800">Semua Pekan (Unpaid)</span>
                                    </div>
                                    @for ($i = 1; $i <= 16; $i++)
                                        @if ($users->{'p' . $i} != 1)
                                            <div class="flex items-center justify-between cursor-pointer hover:bg-gray-50 p-2 rounded transition"
                                                onclick="setValue('p{{ $i }}: {{ $users->{'p' . $i} }}')">
                                                <span class="text-sm font-medium text-gray-800">Pekan
                                                    {{ $i }}:
                                                    @if ($users->{'p' . $i} == 0)
                                                        Unpaid
                                                    @else
                                                        {{ $users->{'p' . $i} }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700">Upload Payment
                            Proof</label>
                        <input type="file" name="image" id="payment_proof"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>
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

<div id="qrisModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden">
    <div class="bg-white p-4 rounded-lg max-w-lg relative flex flex-col items-center">
        <span id="closeModal"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 cursor-pointer text-2xl">&times;</span>
        <img src="https://brenpedia.com/storage/assets/img/uploads/admin/1725739526.jpg" alt="QRIS" class="w-full">
    </div>
</div>

@if ($errors->any())
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div
            class="bg-white p-6 rounded-lg shadow-2xl max-w-lg w-full relative transform transition-transform scale-95 opacity-0 animate-fadeIn">
            <div class="absolute top-0 right-0 mt-2 mr-2">
                <button id="closeErrorModalX"
                    class="text-gray-400 hover:text-gray-600 transition-all duration-300 focus:outline-none">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-exclamation-circle text-6xl text-red-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-red-600 mb-4">Ups... Terjadi kesalahan!</h2>
                <p class="text-gray-600 mb-4 text-left">Message :</p>
                <ul class="text-sm text-red-500 mb-6 text-left list-disc pl-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <ul class="text-sm text-red-500 mb-6 text-left list-disc pl-6">
                    <li>
                        silahkan pilih pekan lainnya atau hubungi admin !!!
                    </li>
                </ul>
                <div class="flex justify-center">
                    <button id="closeErrorModalBtn"
                        class="py-2 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('closeErrorModalX').addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });
        document.getElementById('closeErrorModalBtn').addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('errorModal').querySelector('.transform');
            modal.classList.remove('scale-95', 'opacity-0');
        });
    </script>
@endif


<script>
    const qrisImage = document.getElementById('qrisImage');
    const qrisModal = document.getElementById('qrisModal');
    const closeModal = document.getElementById('closeModal');

    qrisImage.addEventListener('click', function() {
        qrisModal.classList.remove('hidden');
        qrisModal.classList.add('flex');
    });

    closeModal.addEventListener('click', function() {
        qrisModal.classList.add('hidden');
        qrisModal.classList.remove('flex');
    });

    window.addEventListener('click', function(event) {
        if (event.target == qrisModal) {
            qrisModal.classList.add('hidden');
            qrisModal.classList.remove('flex');
        }
    });

    function showDetailsCard() {
        const detailsCard = document.getElementById('detailsCard');
        detailsCard.classList.toggle('hidden');
    }

    function setValue(value) {
        const pekanNumber = value.split(':')[0].replace('p', '');
        const pekanLabel = `P${pekanNumber}`;

        document.getElementById('displaySelectedValue').textContent = pekanLabel;
        document.getElementById('selectedValue').value = pekanLabel;
        document.getElementById('detailsCard').classList.add('hidden');
        updateTotalAmount(1);
    }

    function selectAllPekan() {
        const unpaidPekan = [];
        let pekanCount = 0;

        @for ($i = 1; $i <= 16; $i++)
            if ({{ $users->{'p' . $i} }} == 0) {
                unpaidPekan.push(`P{{ $i }}`);
                pekanCount++;
            }
        @endfor

        const selectedPekan = unpaidPekan.join(', ');
        let message;

        if (pekanCount > 0) {
            message = `Semua (${pekanCount} pekan)`;
        } else {
            message = "Tidak ada pekan unpaid";
        }

        document.getElementById('displaySelectedValue').innerText = message;
        document.getElementById('selectedValue').value = selectedPekan;
        document.getElementById('detailsCard').classList.add('hidden');
        updateTotalAmount(pekanCount);
    }

    function updateTotalAmount(pekanCount) {
        const amountPerPekan = 5000;
        const totalAmount = pekanCount * amountPerPekan;

        document.getElementById('totalAmount').textContent = `Rp ${totalAmount.toLocaleString()}`;
        document.getElementById('amount').value = totalAmount;
    }
</script>

<x-footer></x-footer>
