<x-admin.header>Settings Page</x-admin.header>
<x-admin.sidebar></x-admin.sidebar>

<!-- Container -->
<div class="container mx-auto px-6 py-8 flex space-x-6">
    <div class="w-1/4 bg-white rounded-lg shadow-md p-4">
        <ul id="menu" class="space-y-3">
            <li>
                <button data-target="profile"
                    class="tab-button flex items-center lg:justify-start justify-center text-left w-full p-3 rounded-md hover:bg-blue-100 transition">
                    <i class="fas fa-user lg:mr-2 text-blue-600"></i>
                    <span class="hidden lg:inline menu-text">Profile</span>
                </button>
            </li>
            <li>
                <button data-target="password"
                    class="tab-button flex items-center lg:justify-start justify-center text-left w-full p-3 rounded-md hover:bg-blue-100 transition">
                    <i class="fas fa-lock lg:mr-2 text-blue-600"></i>
                    <span class="hidden lg:inline menu-text">Ganti Password</span>
                </button>
            </li>
        </ul>
    </div>

    <div class="w-full bg-white p-8 rounded-lg shadow-lg transition">
        <form action="{{ route('change.profile') }}" method="post">
            @csrf
            <div id="profile" class="tab-content">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Profile Information</h3>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>Error: {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">Success: {{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ $users->name }}" readonly
                            class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="wa" class="block text-sm font-medium text-gray-700">Whatsapp</label>
                        <input type="text" id="wa" name="wa" value="{{ $users->wa }}"
                            class="mt-2
                        block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500
                        focus:border-blue-500 sm:text-sm"
                            placeholder="masukan nomor whatsapp">
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white text-lg font-bold
                     w-full p-3 rounded-full hover:bg-blue-700">Save</button>
                </div>
            </div>
        </form>

        <form action="{{ route('change.password') }}" method="post">
            @csrf
            <div id="password" class="tab-content hidden">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Change Password</h3>
                <input type="hidden" name="username" value="{{ $users->name }}">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password :</label>
                    <input type="password" id="password" name="password"
                        class="mt-2
                    block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500
                    focus:border-blue-500 sm:text-sm"
                        placeholder="masukan password saat ini">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password :</label>
                        <input type="password" id="newPassword" name="password1" placeholder="masukan password baru"
                            class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" id="confirmPassword" name="password2"
                            class="mt-2 block w-full px-4 py-3
                        border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500
                        sm:text-sm"
                            placeholder="masukan kembali password baru">
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="bg-blue-500 text-white text-lg font-bold
                     w-full p-3 rounded-full hover:bg-blue-700">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('assets/js/admin_pengaturan.js') }}"></script>

<x-admin.footer></x-admin.footer>
