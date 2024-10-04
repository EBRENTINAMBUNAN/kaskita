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
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gradient-to-r from-gray-200 to-gray-300 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Category</th>
                    <th class="py-3 px-6 text-center">Amount</th>
                    <th class="py-3 px-6 text-center">Date</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200 ease-in-out">
                    <td class="py-3 px-6 text-left">Office Supplies</td>
                    <td class="py-3 px-6 text-left">Office</td>
                    <td class="py-3 px-6 text-center">$150.00</td>
                    <td class="py-3 px-6 text-center">2024-10-03</td>
                    <td class="py-3 px-6 text-center">
                        <button onclick="openModal('editModal')"
                            class="text-indigo-500 hover:text-indigo-600 mr-3">Edit</button>
                        <button onclick="openModal('deleteModal')"
                            class="text-red-500 hover:text-red-600">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="addModal" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4">Add New Spending</h3>
            <form>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('addModal')">Cancel</button>
                    <button type="submit"
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
            <form>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                        onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-2xl font-semibold mb-4 text-center">Are you sure you want to delete this item?</h3>
            <div class="flex justify-center">
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2"
                    onclick="closeModal('deleteModal')">Cancel</button>
                <button type="button"
                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
            </div>
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
</script>

<x-admin.footer></x-admin.footer>
