<!-- Header -->
<x-admin.header>Daftar Member</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<!-- Container -->
<div class="container mx-auto px-6 py-8">
    <!-- Header Section with Add Member Button and Search -->
    <div class="flex flex-row justify-between items-center mb-6 space-x-2">
        <!-- Search Input -->
        <div class="flex-grow">
            <input type="text" placeholder="Cari member..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <!-- Add Member Button -->
        <div>
            <button onclick="openModal('addModal')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Tambah Member
            </button>
        </div>
    </div>


    <!-- Responsive Member Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Whatsapp</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($users as $index => $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->username }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->nim }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->wa }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <!-- Edit Button -->
                                <button onclick="openEditModal('{{ $user->id }}')"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <button onclick="openDeleteModal('{{ $user->id }}')"
                                    class="w-4 transform hover:text-red-500 hover:scale-110">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center py-4">
        <p class="text-gray-600">Menampilkan 1 - 10 dari {{ $users->count() }} Member</p>
        <nav class="flex space-x-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Sebelumnya
            </button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Selanjutnya
            </button>
        </nav>
    </div>
</div>

<!-- Add Member Modal -->
<div id="addModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Tambah Member</h3>
            <form action="{{ route('createMember') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Whatsapp</label>
                    <input type="tel" name="wa" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('addModal')">Batal</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div id="editModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Edit Member</h3>
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Whatsapp</label>
                    <input type="tel" name="wa" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('editModal')">Batal</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Member Modal -->
<div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Hapus Member</h3>
            <p class="mb-4">Apakah Anda yakin ingin menghapus member ini?</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('deleteModal')">Batal</button>
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(id) {
        fetch(`/admin/member/${id}`)
            .then(response => response.json())
            .then(data => {
                // Populate the form with the fetched data
                document.querySelector('#editModal input[name="username"]').value = data.username;
                document.querySelector('#editModal input[name="nim"]').value = data.nim;
                document.querySelector('#editModal input[name="email"]').value = data.email;
                document.querySelector('#editModal input[name="wa"]').value = data.wa;
                document.querySelector('#editModal form').action = `/admin/member/update/${id}`;

                // Open the modal
                openModal('editModal');
            })
            .catch(error => console.error('Error fetching member data:', error));
    }

    function openDeleteModal(id) {
        // Set the form action to the correct delete route
        document.getElementById('deleteForm').action = `/admin/member/delete/${id}`;

        // Open the delete modal
        openModal('deleteModal');
    }
</script>



<x-admin.footer></x-admin.footer>
