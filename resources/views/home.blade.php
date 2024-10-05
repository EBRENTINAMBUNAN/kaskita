<x-header>HOMEPAGE</x-header>

<x-sidebar></x-sidebar>

{{-- content --}}
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

            <!-- Carousel Wrapper -->
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

            <!-- Previous Button -->
            <button @click="prevSlide"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-transform duration-300 hover:scale-110">
                &#10094;
            </button>

            <!-- Next Button -->
            <button @click="nextSlide"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-transform duration-300 hover:scale-110">
                &#10095;
            </button>

            <!-- Indicator Dots -->
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

<!-- About Section -->
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

<!-- Custom Divider -->
<div class="flex items-center justify-center my-12">
    <div class="h-1 w-24 bg-blue-600 rounded-full"></div>
    <div class="mx-4 text-gray-500 font-semibold">*******</div>
    <div class="h-1 w-24 bg-blue-600 rounded-full"></div>
</div>

<!-- Search Element -->
<section class="bg-white py-12">
    <div class="container mx-auto px-6 text-center">
        <!-- Title -->
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Cek dan Bayar Tagihan
        </h1>
        <!-- Description -->
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Masukkan nomor NIM kamu untuk melihat informasi pembayaran. Sistem kami memudahkan
            kamu untuk memantau tagihan yang belum dibayar dan melakukan pembayaran dengan cepat dan aman.
        </p>
        <!-- Search Bar -->
        <div class="flex justify-center items-center mt-8">
            <div class="relative w-full max-w-xl">
                <form id="searchForm">
                    @csrf
                    <input type="text" id="searchInput" placeholder="Masukkan nomor induk mahasiswa..."
                        value="{{ request('search') }}"
                        class="w-full bg-gray-100 border border-transparent focus:border-transparent shadow-lg focus:shadow-xl text-gray-700 rounded-full py-4 px-6 pr-14 focus:outline-none focus:ring-4 focus:ring-blue-600 transition-all duration-500">

                    <button type="submit"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 p-3 rounded-full shadow-lg transition-all duration-300">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Search Element -->

<!-- Cards Section -->
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
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-wallet text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp 75.000</h3>
                <p class="text-gray-600 mt-2 text-center">Total Pemasukan</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-chart-line text-4xl text-red-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp 25.000</h3>
                <p class="text-gray-600 mt-2 text-center"> Total Pengeluaran</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-credit-card text-4xl text-yellow-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp 50.000</h3>
                <p class="text-gray-600 mt-2 text-center">Total Pembayaran Online</p>
            </div>
            <!-- Card 4 -->

            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-money-bill-wave text-4xl text-green-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">Rp 50.000</h3>
                <p class="text-gray-600 mt-2 text-center">Total Pembayaran Offline</p>
            </div>
        </div>
    </div>
</section>
{{-- end content --}}

<!-- Modal for displaying user data -->
<div id="userModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="relative bg-white p-6 rounded-3xl shadow-2xl max-w-md w-full transform transition-transform duration-300 ease-in-out">

        <!-- Close Button -->
        <button id="closeModal"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none text-2xl font-bold z-50">
            &times;
        </button>

        <!-- Modal Header: Payment Info -->
        <div class="relative bg-gradient-to-r from-blue-500 to-blue-700 text-white text-center py-6 rounded-t-3xl">
            <h2 class="text-2xl font-bold">Tagihan Pembayaran</h2>
            <p id="modalUsername" class="mt-2 text-lg font-medium uppercase"></p>
        </div>

        <!-- Modal Content -->
        <div id="modalContent" class="bg-white py-6 px-8 rounded-b-3xl text-center">
            <!-- Default state: Payment details -->
            <p id="modalMessage" class="text-gray-600 mb-6"></p>

            <!-- Pay Button -->
            <div id="payButtonContainer" class="hidden justify-center">
                <button id="payBillBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Bayar Tagihan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hide the pay button by default inside the modal
        const payButtonContainer = document.getElementById('payButtonContainer');

        // Function to open the modal and display the username or error message
        function openModal(username, dataExists) {
            const modalUsername = document.getElementById('modalUsername');
            const modalMessage = document.getElementById('modalMessage');
            const payButtonContainer = document.getElementById('payButtonContainer');
            const modal = document.getElementById('userModal');

            if (dataExists) {
                // Populate the modal with user data if found
                modalUsername.textContent = username;
                modalMessage.textContent = "Silakan lakukan pembayaran tagihan Anda untuk melanjutkan.";
                payButtonContainer.style.display = 'flex'; // Show the pay button
            } else {
                // Handle the case when data is not found
                modalUsername.textContent = "Data Tidak Ditemukan";
                modalMessage.textContent = "Maaf, data tagihan tidak ditemukan untuk user ini.";
                payButtonContainer.style.display = 'none'; // Hide the pay button
            }

            // Add flex classes to center the modal and remove hidden
            modal.classList.add('flex', 'justify-center', 'items-center');
            modal.classList.remove('hidden');
        }

        // Close modal event
        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'justify-center',
                'items-center'); // Remove the centering classes when hiding
        });

        // Handle Pay Bill Button click
        document.querySelector('#payBillBtn').addEventListener('click', function() {
            const username = document.querySelector('#modalUsername').textContent;

            // Redirect or handle payment logic using the username
            window.location.href = `/payment/${username}`;
        });

        // Handle form submission with AJAX
        document.querySelector('#searchForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const searchValue = document.querySelector('#searchInput').value;
            const token = document.querySelector('input[name="_token"]').value;

            // Perform AJAX request using Fetch API
            fetch('{{ route('search.user') }}?search=' + searchValue, {
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(user => {
                    if (user.error) {
                        // Pass false to openModal to indicate no data found
                        openModal(null, false);
                    } else {
                        // Pass username and true to openModal when data exists
                        openModal(user.username, true);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // In case of an error (e.g. network issue), also show 'data not found'
                    openModal(null, false);
                });
        });
    });
</script>


<x-footer></x-footer>
