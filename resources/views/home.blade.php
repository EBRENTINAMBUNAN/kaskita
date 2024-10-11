<x-header>HOMEPAGE</x-header>
<x-sidebar></x-sidebar>

<section class="bg-gray-100 py-12">
    <div class="container mx-auto px-6">
        <div x-data="{
            currentSlide: 0,
            slides: ['{{ asset('assets/img/5.jpg') }}', '{{ asset('assets/img/2.jpg') }}', '{{ asset('assets/img/3.jpg') }}', '{{ asset('assets/img/4.jpg') }}', '{{ asset('assets/img/1.jpg') }}'],
            autoSlide() {
                setInterval(() => {
                    this.nextSlide();
                }, 5000); // Auto-slide every 5 seconds
            },
            nextSlide() {
                this.currentSlide = (this.currentSlide === this.slides.length - 1) ? 0 : this.currentSlide + 1;
            },
            prevSlide() {
                this.currentSlide = (this.currentSlide === 0) ? this.slides.length - 1 : this.currentSlide - 1;
            },
        }" x-init="autoSlide()" class="relative overflow-hidden">

            <div class="relative h-96 md:h-screen w-full overflow-hidden">
                <div class="flex transition-transform duration-700 ease-in-out"
                    :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div class="min-w-full h-96 md:h-screen">
                            <img :src="slide" alt="Slide Image" class="h-full w-full object-cover rounded-lg">
                        </div>
                    </template>
                </div>
            </div>

            <button @click="prevSlide"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-transform duration-300 hover:scale-110">
                &#10094;
            </button>
            <button @click="nextSlide"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-transform duration-300 hover:scale-110">
                &#10095;
            </button>

            <div class="flex justify-center mt-4">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index"
                        :class="currentSlide === index ? 'bg-blue-600 scale-125' : 'bg-gray-400'"
                        class="w-3 h-3 mx-1 rounded-full focus:outline-none transition-all duration-300 transform">
                    </button>
                </template>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Apa itu KasKita?
        </h1>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Merupakan sistem manajemen uang kas yang membantu memudahkan dalam mengatur dan melacak semua
            pengeluaran dan
            pemasukan
            dengan
            mudah dan cepat.
        </p>

    </div>
</section>

<div class="flex items-center justify-center my-12">
    <div class="h-1 w-24 bg-blue-600 rounded-full"></div>
    <div class="mx-4 text-gray-500 font-semibold">*******</div>
    <div class="h-1 w-24 bg-blue-600 rounded-full"></div>
</div>

<section class="bg-white py-12">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Cek dan Bayar Tagihan
        </h1>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Masukkan nomor NIM kamu untuk melihat informasi pembayaran. Sistem kami memudahkan
            kamu untuk memantau tagihan yang belum dibayar dan melakukan pembayaran dengan cepat dan aman.
        </p>
        <div class="flex justify-center items-center mt-8">
            <div class="relative w-full max-w-xl">
                <form id="searchForm">
                    @csrf
                    <input type="number" id="searchInput" placeholder="Masukkan nomor induk mahasiswa..."
                        value="{{ request('search') }}"
                        class="w-full bg-gray-100 border border-transparent focus:border-transparent shadow-lg focus:shadow-xl text-gray-700 rounded-full py-4 px-6 pr-14 focus:outline-none focus:ring-4 focus:ring-blue-600 transition-all duration-500"
                        autocomplete="off" required inputmode="numeric" pattern="[0-9]*">


                    <button type="submit"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 p-3 rounded-full shadow-lg transition-all duration-300">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-100 py-12">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Informasi Keuangan</h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-8">
            Kami percaya bahwa transparansi adalah kunci kepercayaan. Sebagai anggota komunitas kami, Anda memiliki
            akses penuh untuk melihat informasi keuangan secara real-time. Temukan ringkasan total uang kas, rincian
            pembayaran offline dan online, serta pengeluaran terkini. Dengan pembaruan yang selalu tepat waktu, Anda
            dapat dengan mudah melacak kondisi keuangan Anda setiap saat!
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-wallet text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp
                    {{ number_format($hasilkas, 0, ',', '.') }}
                </h3>
                <p class="text-gray-600 mt-2 text-center">Total Kas tersedia</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-chart-line text-4xl text-red-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp
                    {{ number_format($totalSpending, 0, ',', '.') }}</h3>
                <p class="text-gray-600 mt-2 text-center"> Total Pengeluaran</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-credit-card text-4xl text-yellow-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp
                    {{ number_format($online, 0, ',', '.') }}</h3>
                <p class="text-gray-600 mt-2 text-center">Total Pembayaran Online</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-money-bill-wave text-4xl text-green-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp
                    {{ number_format($offline, 0, ',', '.') }}</h3>
                <p class="text-gray-600 mt-2 text-center">Total Pembayaran Offline</p>
            </div>
        </div>
    </div>
</section>

<div id="userModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="relative bg-white p-6 rounded-3xl shadow-2xl max-w-md w-full transform transition-transform duration-300 ease-in-out">

        <button id="closeModal"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none text-2xl font-bold z-50">
            &times;
        </button>

        <div class="relative bg-gradient-to-r from-blue-500 to-blue-700 text-white text-center py-6 rounded-t-3xl">
            <h2 class="text-2xl font-bold">Tagihan Pembayaran</h2>
            <p id="modalUsername" class="mt-2 text-lg font-medium uppercase"></p>
        </div>

        <div id="modalContent" class="bg-white py-6 px-8 rounded-b-3xl text-center">
            <p id="modalMessage" class="text-gray-600 mb-6"></p>
            <div id="payButtonContainer" class="hidden justify-center">
                <button id="payBillBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Bayar Tagihan
                </button>
            </div>
        </div>
    </div>
</div>

<div id="successModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 transition-opacity duration-500 ease-out">
    <div class="bg-white p-6 rounded-3xl shadow-2xl max-w-md w-full relative">
        <div id="partyPopper" class="absolute inset-0 z-0 pointer-events-none hidden">
            <div class="w-full h-full flex justify-center items-center space-x-4">
                <div class="bg-blue-600 w-8 h-8 rounded-full animate-pop"></div>
                <div class="bg-red-500 w-8 h-8 rounded-full animate-pop"></div>
                <div class="bg-yellow-500 w-8 h-8 rounded-full animate-pop"></div>
                <div class="bg-green-500 w-8 h-8 rounded-full animate-pop"></div>
            </div>
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-center border-b pb-4">
                <h5 class="text-lg font-bold text-blue-600">Success!</h5>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="mt-6">
                <p class="text-center text-gray-700">{{ session('success') }}</p>
                <p class="text-center text-gray-700">Terima kasih :)</p>
            </div>
            <div class="flex justify-center mt-6">
                <button id="closeModalFooterBtn"
                    class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-6 py-3 rounded-full hover:from-green-400 hover:to-blue-500 transition-all duration-300">Close</button>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const closeModalFooterBtn = document.getElementById('closeModalFooterBtn');
            const partyPopper = document.getElementById('partyPopper');

            function showModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.classList.add('opacity-100');
                partyPopper.classList.remove('hidden');
                setTimeout(() => {
                    partyPopper.classList.add('hidden');
                }, 3000);
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.classList.remove('opacity-100');
            }
            showModal();
            closeModalBtn.addEventListener('click', closeModal);
            closeModalFooterBtn.addEventListener('click', closeModal);
        });
    </script>
@endif

<style>
    @keyframes pop {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.5);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0;
        }
    }

    .animate-pop {
        animation: pop 1s ease-in-out infinite;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payButtonContainer = document.getElementById('payButtonContainer');

        function openModal(username, dataExists) {
            const modalUsername = document.getElementById('modalUsername');
            const modalMessage = document.getElementById('modalMessage');
            const payButtonContainer = document.getElementById('payButtonContainer');
            const modal = document.getElementById('userModal');

            if (dataExists) {
                modalUsername.textContent = username;
                modalMessage.textContent = "Silakan lakukan pembayaran tagihan Anda untuk melanjutkan.";
                payButtonContainer.style.display = 'flex';
            } else {
                modalUsername.textContent = "Data Tidak Ditemukan";
                modalMessage.textContent = "Maaf, data tagihan tidak ditemukan untuk user ini.";
                payButtonContainer.style.display = 'none';
            }
            modal.classList.add('flex', 'justify-center', 'items-center');
            modal.classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'justify-center',
                'items-center');
        });

        document.querySelector('#payBillBtn').addEventListener('click', function() {
            const username = document.querySelector('#modalUsername').textContent;
            window.location.href = `/payment/${username}`;
        });

        document.querySelector('#searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const searchValue = document.querySelector('#searchInput').value;
            const token = document.querySelector('input[name="_token"]').value;

            fetch('{{ route('search.user') }}?search=' + searchValue, {
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(user => {
                    if (user.error) {
                        openModal(null, false);
                    } else {
                        openModal(user.username, true);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    openModal(null, false);
                });
        });
    });
</script>

<x-footer></x-footer>
