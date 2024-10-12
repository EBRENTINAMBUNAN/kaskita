<x-header></x-header>

<body>
    {{-- konten --}}
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-blue-500 to-indigo-600">
        <div
            class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg transform transition duration-500 hover:shadow-2xl">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-6 tracking-tight">Reset Password</h2>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="wa" value="{{ $wa }}">

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out transform hover:scale-105"
                        placeholder="Masukkan password baru">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out transform hover:scale-105"
                        placeholder="Konfirmasi password">
                </div>

                <div>
                    <button type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-md shadow-md hover:from-indigo-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:scale-105">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- end konten --}}
</body>

</html>
