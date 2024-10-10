<x-admin.header>PROSES-MANUAL</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Silahkan pilih member</h2>

        <!-- Combo Box 1 (Username) -->
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username :</label>
            <div class="relative mt-1">
                <select id="username"
                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500">
                    <option value="">Pilih Username</option>
                    @foreach ($members as $item)
                        <option value="{{ $item->username }}">{{ $item->username }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.5 7.5L10 12.5l4.5-5H5.5z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Combo Box 2 (Pekan) -->
        <div class="mb-4">
            <label for="pekan" class="block text-sm font-medium text-gray-700">Pekan :</label>
            <div class="relative mt-1">
                <select id="pekan"
                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500">
                    <option value="">Pilih Pekan</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.5 7.5L10 12.5l4.5-5H5.5z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="mt-6 text-center">
            <button id="submitButton"
                class="px-6 py-3 bg-blue-500 w-full text-white font-semibold rounded-lg shadow-lg hover:bg-blue-800 transition-all duration-300 transform focus:outline-none focus:ring-4 focus:ring-indigo-300">
                Submit
            </button>
        </div>
    </div>
</div>

<!-- Modal respons -->
<div id="responseModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
                Sukses
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500" id="modalMessage">
                    Data berhasil diperbarui.
                </p>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                    id="closeModalButton">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function updatePekanOptions(username) {
            $.ajax({
                url: '{{ route('get.pekan') }}',
                type: 'GET',
                data: {
                    username: username
                },
                success: function(data) {
                    const pekanSelect = $('#pekan');
                    pekanSelect.empty().append('<option value="">Pilih Pekan</option>');
                    $.each(data, function(key) {
                        pekanSelect.append(`<option value="${key}">${key}</option>`);
                    });
                },
                error: function() {
                    $('#pekan').empty().append('<option value="">Pekan tidak ditemukan</option>');
                }
            });
        }

        $('#username').change(function() {
            const username = $(this).val();
            if (username) {
                updatePekanOptions(username);
            } else {
                $('#pekan').empty().append('<option value="">Pilih Pekan</option>');
            }
        });

        $('#submitButton').click(function(e) {
            e.preventDefault();

            const username = $('#username').val();
            const pekan = $('#pekan').val();
            const submitButton = $(this);
            submitButton.text('Processing...').prop('disabled', true);

            if (username && pekan) {
                $.ajax({
                    url: '{{ route('update.pekan') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        username: username,
                        pekan: pekan
                    },
                    success: function() {
                        showModal('Sukses',
                            `Pembayaran uang kas pekan ke ${pekan} dengan username ${username} telah lunas`
                        );
                    },
                    error: function() {
                        showModal('Gagal', 'Gagal memperbarui data.');
                    },
                    complete: function() {
                        resetForm();
                    }
                });
            } else {
                showModal('Peringatan', 'Silakan pilih username dan pekan terlebih dahulu.');
                resetForm();
            }
        });

        function showModal(title, message) {
            $('#modalTitle').text(title);
            $('#modalMessage').text(message);
            $('#responseModal').removeClass('hidden');
        }

        function resetForm() {
            $('#username').val('');
            $('#pekan').empty().append('<option value="">Pilih Pekan</option>');
            const submitButton = $('#submitButton');
            submitButton.text('Submit').prop('disabled', false);
        }

        $('#closeModalButton').click(function() {
            $('#responseModal').addClass('hidden');
            resetForm();
        });
    });
</script>

<x-admin.footer></x-admin.footer>
