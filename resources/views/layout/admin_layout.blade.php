<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - </title>    
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://kit.fontawesome.com/526e979df3.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
          
        </div>
        <div class="flex items-center">
            <div class="flex items-center ml-3">
              <div>
                <a href="#" class="flex s">
                  <img src="{{ asset('assets/image/smkn1_logo.png') }}" class="h-8 mr-3" alt="FlowBite Logo" />
                  <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">E-Manage</span>
                </a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>
  <aside class="fixed top-0 left-0 z-50 w-fit h-screen bg-gray-50 border-2 ">
    <div class="h-full px-2 pb-2">
      <div class="flex items-center">
        <div>
          <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
          </button>
        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
          @if(Auth::guard('admin')->check())
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
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
            </li>
            <li>
              <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" onclick="logout()" role="menuitem">Sign out</a>
            </li>
          </ul>
        </div>
      </div>
      <ul class="grid relative top-1/3">
        <li>
          <div class="container block" data-tooltip-target="tooltip-home" data-tooltip-placement="right">
            <a href="{{ route('dashboard') }}" class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
              <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
              <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
            </svg>
            <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
              Home
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            </a>
          </div>
        </li>
        <li>
          <div class="container block" data-tooltip-target="tooltip-guru" data-tooltip-placement="right">
            <a href="{{ route('guru') }}" class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
              </svg>
          <div id="tooltip-guru" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
              Guru
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            </a>
          </div>
        </li>
        <li>
          <div class="container block" data-tooltip-target="tooltip-ptk" data-tooltip-placement="right">
            <a href="{{ route('ptk') }}" class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
              <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
              <div id="tooltip-ptk" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
              PTK
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            </a>
          </div>
        </li>
        <li>
          <div class="container block" data-tooltip-target="tooltip-laporan" data-tooltip-placement="right">
            <a href="{{ route('mapel') }}" class="block items-center p-2 {{ Request::is('home') ? 'text-white bg-gray-900' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ Request::is('home') ? 'text-white' : 'text-gray-500' }}">
              <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
              <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
            </svg>
            <div id="tooltip-laporan" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
              Mata Pelajaran
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </aside>
  <div id="toast-alert" class="invisible flex fixed bottom-5 right-5 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <svg aria-hidden="true" class="w-5 h-5 text-blue-600 dark:text-blue-500" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg>
    <div id= "pesan" class="pl-4 text-sm font-normal">Message sent successfully.</div>
  </div>
  <div class="p-4 ml-20">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
      @yield("content")
    </div>
 </div>
     

  
  <script>
    // Tambahkan logic untuk menyimpan menu aktif pada setiap halaman
    let activeMenu = '';

    // Atur menu aktif berdasarkan route yang sedang dibuka
    switch('{{ Route::currentRouteName() }}') {
        case 'home':
            activeMenu = 'home';
            break;
        case 'guru':
            activeMenu = 'guru';
            break;
        // Tambahkan case untuk setiap halaman dengan menu sidebar yang sesuai
    }

    // Tambahkan class 'bg-blue-500' pada item sidebar yang sesuai dengan menu aktif
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarItems = document.querySelectorAll('#logo-sidebar a');
        sidebarItems.forEach(item => {
            if (item.classList.contains(activeMenu)) {
                item.classList.add('bg-blue-500');
            }
        });
    });
</script>
<script>
  function logout() {
      fetch('{{ route("admin.logout") }}', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      })
      .then(response => {
          if (response.ok) {
              // Logout berhasil, lakukan pengalihan halaman ke halaman login
              window.location.href = '{{ route("login") }}';
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





                                    