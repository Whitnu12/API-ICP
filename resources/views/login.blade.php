@extends('layout.login_layout')

@section('content')

    <body>
        <div id="alert-1" class="fixed w-full  inset-auto z-50 flex p-4 mb-4 text-white  bg-red-500 invisible"
            role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                unauthorized
            </div>
        </div>

        <div class="h-screen md:flex">
            <div
                class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-green-800 to-green-400 i justify-around items-center hidden">
                <div>
                    <h1 class="text-white font-bold text-4xl font-sans">SMKN 1 Kota Bima</h1>
                    <p class="text-white mt-1">E-Management Solution For School</p>
                </div>
                <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
                </div>
                <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
                </div>
                <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
                <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            </div>
            <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
                <form class="bg-white" id="loginForm" action="{{ route('admin.login') }}"
                    onsubmit="event.preventDefault(); loginUser(this);">
                    @csrf
                    <h1 class="text-gray-800 font-bold text-2xl mb-1">Hello Again!</h1>
                    <p class="text-sm font-normal text-gray-600 mb-7">Welcome Back</p>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <input
                            class="pl-2 outline-none leading-tight focus:outline-none focus:bg-white focus:border-purple-500 border-none"
                            type="email" name="email" id="email" placeholder="Email Address" required autofocus />
                    </div>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <input class="pl-2 outline-none border-none" type="password" name="password" id="password"
                            placeholder="Password" required />
                    </div>
                    <button type="submit" id="login"
                        class="block w-full bg-green-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2 hover:bg-green-400">Login</button>
                </form>
            </div>
        </div>

        <script>
            function handleLoginResponse(response) {
                if (response.message === 'success') {
                    // Pengalihan halaman ke dashboard
                    window.location.href = '{{ route('dashboard') }}';
                } else {
                    // Tampilkan pesan error jika login tidak berhasil
                    // Tampilkan pesan error jika login tidak berhasil
                    const alertElement = document.getElementById('alert-1');
                    alertElement.classList.remove('invisible');
                    alertElement.classList.add('visible');

                    setTimeout(() => {
                        alertElement.classList.remove('visible');
                        alertElement.classList.add('invisible');
                    }, 3000);
                }
            }

            function loginUser(form) {
                const formData = new FormData(form);

                // Ambil CSRF token dari cookie/session
                const csrfToken = getCsrfToken();

                // Menambahkan token CSRF ke header
                const headers = {
                    'X-CSRF-TOKEN': csrfToken
                };

                fetch(form.action, {
                        method: 'POST',
                        headers: headers,
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => handleLoginResponse(data))
                    .catch(error => console.error(error));
            }

            // Fungsi untuk mendapatkan CSRF token dari cookie/session
            function getCsrfToken() {
                // Ubah sesuai dengan nama cookie/session yang menyimpan CSRF token
                const csrfCookieName = 'XSRF-TOKEN';

                // Ambil CSRF token dari cookie
                const cookieValue = document.cookie
                    .split('; ')
                    .find(row => row.startsWith(csrfCookieName))
                    .split('=')[1];

                return decodeURIComponent(cookieValue);
            }
        </script>
    </body>
@endsection
