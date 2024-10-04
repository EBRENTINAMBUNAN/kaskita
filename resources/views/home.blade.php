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

<x-footer></x-footer>
