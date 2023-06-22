<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/526e979df3.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <nav class="fixed top-0 z-50 w-full bg-white shadow-md border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>

                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div>
                            <a href="#" class="flex s">
                                <img src="{{ asset('assets/image/smkn1_logo.png') }}" class="h-8 mr-3"
                                    alt="SMKN 1 kobi logo" />
                                <span
                                    class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">E-Manage</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <aside class="fixed top-0 left-0 z-50 w-fit h-screen bg-white shadow-md">
        <div class="h-full px-2 pb-2">
            <div class="flex items-center">
                <div class="pt-3 ">
                    <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown-user">
                    @if (Auth::guard('admin')->check())
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::guard('admin')->user()->nama }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::guard('admin')->user()->email }}
                            </p>
                        </div>
                    @endif
                    <ul class="py-1" role="none">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">Settings</a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="logout()" role="menuitem">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="grid relative top-1/4">
                <li>
                    <div class="container block" data-tooltip-target="tooltip-home" data-tooltip-placement="right">
                        <a href="{{ route('dashboard') }}"
                            class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
                                <path
                                    d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                <path
                                    d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                            </svg>
                            <div id="tooltip-home" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Home
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="container block" data-tooltip-target="tooltip-guru" data-tooltip-placement="right">
                        <a href="{{ route('ptk') }}"
                            class="block items-center p-2 {{ Request::is('ptk') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div id="tooltip-guru" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                PTK
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="container block" data-tooltip-target="tooltip-mapel" data-tooltip-placement="right">
                        <a href="{{ route('mapel') }}"
                            class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.5 16H16C17.8856 16 18.8284 16 19.4142 15.4142C20 14.8284 20 13.8856 20 12V7C20 5.11438 20 4.17157 19.4142 3.58579C18.8284 3 17.8856 3 16 3H8C6.11438 3 5.17157 3 4.58579 3.58579C4 4.17157 4 5.11438 4 7V18.5C4 17.1193 5.11929 16 6.5 16ZM9 6C7.89543 6 7 6.89543 7 8C7 9.10457 7.89543 10 9 10L15 10C16.1046 10 17 9.10457 17 8C17 6.89543 16.1046 6 15 6L9 6Z" />
                                <path
                                    d="M19.4142 15.4142L18.7071 14.7071L18.7071 14.7071L19.4142 15.4142ZM19.4142 3.58579L18.7071 4.29289L18.7071 4.29289L19.4142 3.58579ZM9 6V5V6ZM9 10V9V10ZM15 10V11V10ZM15 6V5V6ZM16 15H6.5V17H16V15ZM18.7071 14.7071C18.631 14.7832 18.495 14.8774 18.0613 14.9357C17.5988 14.9979 16.9711 15 16 15V17C16.9145 17 17.701 17.0021 18.3278 16.9179C18.9833 16.8297 19.6117 16.631 20.1213 16.1213L18.7071 14.7071ZM19 12C19 12.9711 18.9979 13.5988 18.9357 14.0613C18.8774 14.495 18.7832 14.631 18.7071 14.7071L20.1213 16.1213C20.631 15.6117 20.8297 14.9833 20.9179 14.3278C21.0021 13.701 21 12.9145 21 12H19ZM19 7V12H21V7H19ZM18.7071 4.29289C18.7832 4.36902 18.8774 4.50496 18.9357 4.9387C18.9979 5.40121 19 6.02892 19 7H21C21 6.08546 21.0021 5.29896 20.9179 4.67221C20.8297 4.01669 20.631 3.38834 20.1213 2.87868L18.7071 4.29289ZM16 4C16.9711 4 17.5988 4.00212 18.0613 4.06431C18.495 4.12262 18.631 4.21677 18.7071 4.29289L20.1213 2.87868C19.6117 2.36902 18.9833 2.17027 18.3278 2.08214C17.701 1.99788 16.9145 2 16 2V4ZM8 4H16V2H8V4ZM5.29289 4.29289C5.36902 4.21677 5.50496 4.12262 5.9387 4.06431C6.40121 4.00212 7.02892 4 8 4V2C7.08546 2 6.29896 1.99788 5.67221 2.08214C5.01669 2.17027 4.38834 2.36902 3.87868 2.87868L5.29289 4.29289ZM5 7C5 6.02892 5.00212 5.40121 5.06431 4.9387C5.12262 4.50496 5.21677 4.36902 5.29289 4.29289L3.87868 2.87868C3.36902 3.38834 3.17027 4.01669 3.08214 4.67221C2.99788 5.29896 3 6.08546 3 7H5ZM5 18.5V7H3V18.5H5ZM6.5 15C4.567 15 3 16.567 3 18.5H5C5 17.6716 5.67157 17 6.5 17V15ZM8 8C8 7.44772 8.44772 7 9 7V5C7.34315 5 6 6.34315 6 8H8ZM9 9C8.44772 9 8 8.55228 8 8H6C6 9.65685 7.34315 11 9 11V9ZM15 9L9 9V11H15V9ZM16 8C16 8.55229 15.5523 9 15 9V11C16.6569 11 18 9.65686 18 8H16ZM15 7C15.5523 7 16 7.44772 16 8H18C18 6.34315 16.6569 5 15 5V7ZM9 7L15 7V5L9 5V7ZM11 20H6.5V22H11V20ZM3 18.5C3 20.433 4.567 22 6.5 22V20C5.67157 20 5 19.3284 5 18.5H3Z" />
                                <path d="M20 21H10" stroke="#6b7280" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <div id="tooltip-mapel" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <span class="overflow-auto">mata pelajaran</span>
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="container block" data-tooltip-target="tooltip-laporan"
                        data-tooltip-placement="right">
                        <a href="{{ route('laporan') }}"
                            class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
                                <path xmlns="http://www.w3.org/2000/svg"
                                    d="M16.707 2.293A.996.996 0 0 0 16 2H8a.996.996 0 0 0-.707.293l-5 5A.996.996 0 0 0 2 8v8c0 .266.105.52.293.707l5 5A.996.996 0 0 0 8 22h8c.266 0 .52-.105.707-.293l5-5A.996.996 0 0 0 22 16V8a.996.996 0 0 0-.293-.707l-5-5zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z" />
                            </svg>
                            <div id="tooltip-laporan" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Laporan
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="container block" data-tooltip-target="tooltip-kelas" data-tooltip-placement="right">
                        <a href="{{ route('kelas') }}"
                            class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                            </svg>
                            <div id="tooltip-kelas" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <span class="overflow-auto">Kelas</span>
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="container block" data-tooltip-target="tooltip-sekolah"
                        data-tooltip-placement="right">
                        <a href="{{ route('sekolah') }}"
                            class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path
                                    d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                                <path
                                    d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                                <path
                                    d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                            </svg>
                            <div id="tooltip-sekolah" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Sekolah
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <div id="toast-alert"
        class="invisible flex fixed bottom-5 right-5 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
        role="alert">
        <svg aria-hidden="true" class="w-5 h-5 text-blue-600 dark:text-blue-500" focusable="false" data-prefix="fas"
            data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z">
            </path>
        </svg>
        <div id="pesan" class="pl-4 text-sm font-normal">Message sent successfully.</div>
    </div>
    <div class="p-4 ml-20">
        <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
            @yield('content')
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
    </svg>


    <script>
        function logout() {
            fetch('{{ route('admin.logout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Logout berhasil, lakukan pengalihan halaman ke halaman login
                        window.location.href = '{{ route('login') }}';
                    } else {
                        // Logout gagal, tampilkan pesan error
                        alert('Logout failed.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Logout failed.');
                });
        }
    </script>
</body>

</html>
