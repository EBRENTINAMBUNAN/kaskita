<x-admin.header>QRIS Upload Page</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">
    <div class="bg-white shadow-lg rounded-lg p-4">

        @if ($qrisCount == 1)

            <div class="mb-4 relative">
                @if (!empty($qris->image))
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('assets/img/uploads/admin/' . $qris->image) }}" alt="QRIS Preview"
                            class="border border-gray-300 rounded-lg shadow-lg w-full max-w-xs h-auto object-cover mb-4">

                        <button id="delete-button"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-red-700 transition duration-300 w-full max-w-xs text-center"
                            onclick="event.preventDefault(); processDelete();">
                            Hapus
                        </button>
                    </div>

                    <form id="delete-image-form" action="{{ route('delete.qris.image', $qris->id) }}" method="POST"
                        style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @else
                    <div class="flex justify-center">
                        <p class="text-gray-500">Tidak ada gambar QRIS yang diupload</p>
                    </div>
                @endif
            </div>
        @else
            <form id="upload-form" action="{{ route('create.qris') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return processUpload();">
                @csrf

                <div id="drop-zone"
                    class="border-dashed border-4 border-blue-500 py-10 flex flex-col items-center justify-center"
                    ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                    <i class="fas fa-cloud-upload-alt text-3xl text-blue-500 mb-4"></i>
                    <p class="text-gray-600">Drag & Drop File atau</p>
                    <label
                        class="bg-blue-600 text-white px-6 py-3 mt-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">
                        <input id="file-input" type="file" name="image" class="hidden" required
                            onchange="handleFileSelect(event)">
                        Pilih File
                    </label>
                </div>

                <p id="file-name" class="text-gray-600 mt-2"></p> <!-- Untuk menampilkan nama file -->

                <div class="mt-6">
                    <input type="text" name="name" placeholder="Masukkan Nama Merchant"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                <div class="mt-6 mb-4 text-right">
                    <button id="upload-button" type="submit"
                        class="bg-green-600 w-full text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-700 transition duration-300">
                        Upload QRIS
                    </button>
                </div>
            </form>
        @endif

    </div>
</div>

<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const fileNameDisplay = document.getElementById('file-name');

    function handleDragOver(event) {
        event.preventDefault();
        dropZone.classList.add('border-blue-700');
    }

    function handleDrop(event) {
        event.preventDefault();
        dropZone.classList.remove('border-blue-700');
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            displayFileName(files[0].name);
        }
    }

    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (file) {
            displayFileName(file.name);
        }
    }

    function displayFileName(name) {
        fileNameDisplay.textContent = `File: ${name}`;
    }

    function processUpload() {
        var uploadButton = document.getElementById('upload-button');
        uploadButton.innerHTML = 'Processing...';
        uploadButton.disabled = true;
        return true;
    }

    function processDelete() {
        var deleteButton = document.getElementById('delete-button');
        deleteButton.innerHTML = 'Processing...';
        deleteButton.disabled = true;
        document.getElementById('delete-image-form').submit();
    }
</script>

<x-admin.footer></x-admin.footer>
