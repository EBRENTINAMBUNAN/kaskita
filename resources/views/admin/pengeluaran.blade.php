<x-admin.header>Spending Page</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Spending Management</h2>
        <button onclick="openModal('addModal')"
            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-md shadow-lg hover:from-blue-600 hover:to-indigo-700 transition duration-300 ease-in-out">
            + Add Spending
        </button>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                <tr>
                    <th class="py-3 px-6 text-center">Date</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Amount</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @foreach ($spendings as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200 ease-in-out">
                        <td class="py-3 px-6 text-center">{{ $item->created_at }}</td>
                        <td class="py-3 px-6 text-left">{!! nl2br(e($item->deskripsi)) !!}</td>
                        <td class="py-3 px-6 text-center">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <button onclick="openEditModal('{{ $item->id }}')"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal('{{ $item->id }}')"
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
</div>

<div id="addModal" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Add New Spending</h3>
            <form action="{{ route('create.pengeluaran') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="5"
                        placeholder="Masukkan deskripsi..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('addModal')">Cancel</button>
                    <button type="submit" id="addSubmit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="editModal" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Edit Spending</h3>
            <form method="POST" id="editSpendingForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="5"
                        placeholder="Masukkan deskripsi..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit" id="updateSubmit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
                    <button type="submit" id="deleteSubmit"
                        class="bg-red-500 text-white px-4 py-2
                        rounded-md hover:bg-red-600">Hapus</button>
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
        fetch(`/admin/pengeluaran/${id}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#editModal textarea[name="deskripsi"]').value = data.deskripsi;
                document.querySelector('#editModal input[name="amount"]').value = parseInt(data
                    .amount);
                document.querySelector('#editModal form').action = `/admin/pengeluaran/update/${id}`;
                openModal('editModal');
            })
            .catch(error => console.error('Error fetching spending data:', error));
    }

    function openDeleteModal(id) {
        document.querySelector('#deleteForm').action = `/admin/pengeluaran/delete/${id}`;
        openModal('deleteModal');
    }

    function deleteSpending(event) {

        const form = document.querySelector('#deleteForm');
        const url = form.action;

        var submitButton = document.getElementById('deleteSubmit');
        submitButton.innerHTML = 'Processing...';
        submitButton.disabled = true;

        fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    closeModal('deleteModal');
                    window.location.reload();
                } else {
                    console.error('Error deleting spending:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    document.querySelector('#deleteForm').addEventListener('submit', deleteSpending);

    document.getElementById('addModal').addEventListener('submit', function(e) {
        var submitButton = document.getElementById('addSubmit');
        submitButton.innerHTML = 'Processing...';
        submitButton.disabled = true;
    });

    document.getElementById('editModal').addEventListener('submit', function(e) {
        var submitButton = document.getElementById('updateSubmit');
        submitButton.innerHTML = 'Processing...';
        submitButton.disabled = true;
    });
</script>

<x-admin.footer></x-admin.footer>
