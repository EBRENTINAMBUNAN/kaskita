<x-admin.header>Settings Page</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

{{-- konten --}}
<div class="container mx-auto px-6 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Account Settings</h2>

        <!-- Profile Section -->
        <div class="border-b pb-4 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Profile Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Password Section -->
        <div class="border-b pb-4 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Change Password</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password Field -->
                <div>
                    <label for="current-password" class="block text-sm font-medium text-gray-700">Current
                        Password</label>
                    <input type="password" id="current-password" name="current-password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- New Password Field -->
                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" id="new-password" name="new-password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            <!-- Confirm Password Field -->
            <div class="mt-6">
                <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Save Changes Button -->
        <div class="mt-6 flex justify-end">
            <button
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save
                Changes</button>
        </div>
    </div>
</div>
{{-- end konten --}}

<x-admin.footer></x-admin.footer>
