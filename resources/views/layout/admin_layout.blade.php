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

    <nav class="fixed top-0 z-50 w-full bg-white border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start ml-20">
                    <h1 class="text-xl font-semibold">
                        @if (request()->is('dashboard'))
                            Home
                        @elseif(request()->is('dashboard/matapelajaran'))
                            Mata Pelajaran
                        @endif
                    </h1>
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
    <aside class="fixed top-0 left-0 z-50 h-screen bg-white shadow-md w-fit">
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
                    @if (Auth::guard('user')->check())
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::guard('user')->user()->nama }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::guard('user')->user()->email }}
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
                                role="menuitem">Mata</a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="logout()" role="menuitem">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="relative grid top-1/3">
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
                                <span class="overflow-auto">mata_pelajaran</span>
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                </li>







            </ul>
        </div>
    </aside>
    <div id="toast-alert"
        class="fixed flex items-center invisible w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow bottom-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
        role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-green-500">
            <path fill-rule="evenodd"
                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                clip-rule="evenodd" />
        </svg>


        <div id="pesan" class="pl-4 text-sm font-normal">Message sent successfully.</div>
    </div>
    <div class="p-4 ml-20">
        <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
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
