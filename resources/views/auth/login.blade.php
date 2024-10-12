<x-admin.header>ADMINPAGE</x-admin.header>

{{-- content --}}
<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-300 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-6">{{ config('app.name') }}</h2>
            <p class="text-center text-sm text-gray-600 mb-6">Masuk ke akun admin Anda</p>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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


            <form class="mt-8 space-y-6" action="{{ route('proses.login') }}" method="post">
                @csrf
                <!-- Username Input -->
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label class="sr-only" for="name">Username</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="mb-4 appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Username" />
                    </div>

                    <!-- Password Input with Show/Hide Toggle -->
                    <div class="relative
                            mt-4">
                        <label class="sr-only" for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Password" />
                        <!-- Eye Icon for Show/Hide Password -->
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                            onclick="togglePasswordVisibility()">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <!-- Default icon (closed eye) -->
                                <path id="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18M13.875 18.825A9.518 9.518 0 0012 19.5c-4.477 0-8.268-2.943-9.542-7a9.518 9.518 0 011.625-2.325M4.084 4.084L19.917 19.917"
                                    style="display: none;" />
                                <!-- Open eye icon -->
                                <path id="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <label for="remember" class="ml-2 block text-sm text-gray-600">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500" onclick="openModal()">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-500 hover:from-blue-600 hover:to-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>
                </div>
            </form>
        </div>
        <div class="container mx-auto px-6 text-white text-center space-y-6">
            <!-- Social Media Icons -->
            <div class="flex justify-center space-x-6">
                <!-- GitHub Icon -->
                <a href="https://github.com/EBRENTINAMBUNAN" target="_blank"
                    class="text-white hover:text-gray-300 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 .5C5.4.5.1 5.7.1 12.3c0 5.2 3.4 9.6 8.1 11.2.6.1.8-.3.8-.6v-2.1c-3.3.7-4-1.5-4-1.5-.6-1.5-1.4-1.9-1.4-1.9-1.2-.8 0-.8.1-.8 1.3.1 2 1.4 2 1.4 1.2 2 3 1.5 3.8 1.1.1-.9.5-1.5.9-1.9-2.7-.3-5.6-1.3-5.6-6 0-1.3.5-2.4 1.2-3.3-.2-.3-.6-1.3.1-2.7 0 0 1.1-.3 3.5 1.3 1-.3 2-.4 3-.4 1.1 0 2.2.2 3.2.5 2.5-1.7 3.5-1.3 3.5-1.3.7 1.5.3 2.4.1 2.7.8.9 1.2 2 1.2 3.3 0 4.7-2.9 5.6-5.7 5.9.5.5 1 1.3 1 2.6v3.1c0 .4.3.7.8.6 4.7-1.5 8-6 8-11.2C23.9 5.7 18.6.5 12 .5z" />
                    </svg>
                </a>
                <!-- Instagram Icon -->
                <a href="https://instagram.com/ebren_tinambunan" target="_blank"
                    class="text-white hover:text-gray-300 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 2 .3 2.7.6.6.3 1.1.7 1.6 1.2.5.5.9 1 .1.6.4.7.5 1.5.6 2.7.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 2-.6 2.7-.3.6-.7 1.1-1.2 1.6-.5.5-1 .9-1.6 1.2-.7.4-1.5.5-2.7.6-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-2-.3-2.7-.6-.6-.3-1.1-.7-1.6-1.2-.5-.5-.9-1-.1.6-.4-.7-.5-1.5-.6-2.7-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-2 .6-2.7.3-.6.7-1.1 1.2-1.6.5-.5 1-.9 1.6-1.2.7-.4 1.5-.5 2.7-.6 1.3-.1 1.7-.1 4.9-.1zm0 1.8c-3.1 0-3.5 0-4.7.1-1 .1-1.6.2-2.1.5-.5.2-.9.5-1.3.9-.4.4-.7.8-.9 1.3-.3.5-.4 1.1-.5 2.1-.1 1.2-.1 1.6-.1 4.7s0 3.5.1 4.7c.1 1 .2 1.6.5 2.1.2.5.5.9.9 1.3.4.4.8.7 1.3.9.5.3 1.1.4 2.1.5 1.2.1 1.6.1 4.7.1s3.5 0 4.7-.1c1-.1 1.6-.2 2.1-.5.5-.2.9-.5 1.3-.9.4-.4.7-.8.9-1.3.3-.5.4-1.1.5-2.1.1-1.2.1-1.6.1-4.7s0-3.5-.1-4.7c-.1-1-.2-1.6-.5-2.1-.2-.5-.5-.9-.9-1.3-.4-.4-.8-.7-1.3-.9-.5-.3-1.1-.4-2.1-.5-1.2-.1-1.6-.1-4.7-.1zm0 2.9a5.8 5.8 0 1 1 0 11.6 5.8 5.8 0 0 1 0-11.6zm7.5-.7a1.35 1.35 0 1 1 0 2.7 1.35 1.35 0 0 1 0-2.7zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10z" />
                    </svg>
                </a>
                <!-- Facebook Icon -->
                <a href="https://www.facebook.com/debi.rahmad.14" target="_blank"
                    class="text-white hover:text-gray-300 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.5-4.5-10-10-10S2 6.5 2 12c0 5 3.7 9.2 8.5 9.9v-7h-2.5v-3h2.5V9.5c0-2.5 1.5-3.8 3.7-3.8 1 0 1.8.1 2.1.1v2.5h-1.5c-1.2 0-1.5.8-1.5 1.4V12h3l-.5 3h-2.5v7c4.8-.7 8.5-4.9 8.5-9.9z" />
                    </svg>
                </a>
            </div>

            <!-- Footer Text -->
            <p class="mt-4">© 2024 Bendevelopment. All rights reserved.</p>
        </div>
    </div>
</div>
{{-- end content --}}


<!-- Modal -->
<div id="forgotPasswordModal"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 invisible opacity-0 transition-opacity duration-300">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Lupa Password</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <form action="{{ route('send.reset.password') }}" method="POST">
            @csrf
            <input type="text" name="wa" id="wa" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Masukan Nomor Whatsapp">

            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-blue-600 w-full text-white px-4 py-2 rounded-md hover:bg-blue-700">S
                    U B M I T</button>
            </div>
        </form>
    </div>
</div>

<script defer>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        const eyeOpenIcon = document.getElementById("eye-open");
        const eyeClosedIcon = document.getElementById("eye-closed");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeOpenIcon.style.display = "none";
            eyeClosedIcon.style.display = "block";
        } else {
            passwordField.type = "password";
            eyeOpenIcon.style.display = "block";
            eyeClosedIcon.style.display = "none";
        }
    }
</script>


<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{ asset('assets/js/auth_login.js') }}"></script>
</body>

</html>
