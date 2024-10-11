<x-header>SEARCHPAGE</x-header>
<x-sidebar></x-sidebar>

<div class="container mx-auto p-4">
    <div class="text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Mutasi Pembayaran
        </h1>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Cek seluruh detail pembayaran kamu.
        </p>
    </div>
    <div class="flex justify-center items-center mt-8 mb-8">
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();

            var nim = $('#searchInput').val();

            $.ajax({
                url: '{{ route('search.nim') }}',
                type: 'GET',
                data: {
                    nim: nim
                },
                success: function(response) {
                    $('.grid').html('');

                    if (response.success) {
                        if (Array.isArray(response.data)) {
                            response.data.forEach(function(payment) {
                                displayCard(payment);
                            });
                        } else {
                            displayCard(response.data);
                        }
                    } else {
                        $('.grid').html('');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });

        function displayCard(payment) {
            var formattedAmount = parseFloat(payment.amount).toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).replace('Rp', 'Rp ');

            var cardHtml = `
        <div class="bg-gradient-to-r from-blue-100 via-white to-blue-100 shadow-lg rounded-lg border border-gray-200 p-6 mb-4">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-xl font-semibold text-gray-800">${payment.username}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600 font-medium">Tipe : <span class="text-gray-800">${payment.type}</span></p>
                </div>
                <div>
                    <p class="text-gray-600 font-medium">Pekan: <span class="text-gray-800">${payment.pekan}</span></p>
                </div>
            </div>

            <div class="items-center py-4 px-6 bg-blue-50 rounded-lg">
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">${formattedAmount}</p>
                </div>
            </div>
        </div>
    `;
            $('.grid').append(cardHtml);
        }
    });
</script>

</body>

</html>
