@extends('layout.html_layout')
<html>
<head>
    <title>Login</title>
    <script>
        function handleLoginResponse(response) {
            if (response.message === 'success') {
                // Pengalihan halaman ke dashboard
                window.location.href = '{{ route('admin.dashboard') }}';
            } else {
                // Tampilkan pesan error jika login tidak berhasil
                alert(response.message);
            }
        }
    </script>
</head>
<body>
    {{-- <h2>Login</h2>

    <form method="POST" action="{{ route('admin.login') }}" onsubmit="event.preventDefault(); loginUser(this);">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required autofocus>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form> --}}

    <script>
        function loginUser(form) {
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => handleLoginResponse(data))
            .catch(error => console.error(error));
        }
    </script>

<div class="h-screen md:flex">
	<div
		class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-green-800 to-green-400 i justify-around items-center hidden">
		<div>
			<h1 class="text-white font-bold text-4xl font-sans">SMKN 1 Kota Bima</h1>
			<p class="text-white mt-1">E-Management Solution For School</p>
		</div>
		<div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
		<div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
		<div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
		<div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
	</div>
	<div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
		<form class="bg-white" method="POST" action="{{ route('admin.login') }}" onsubmit="event.preventDefault(); loginUser(this);">
            @csrf
			<h1 class="text-gray-800 font-bold text-2xl mb-1">Hello Again!</h1>
			<p class="text-sm font-normal text-gray-600 mb-7">Welcome Back</p>
			<div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
						clip-rule="evenodd" />
				</svg>
						<input class="pl-2 outline-none leading-tight focus:outline-none focus:bg-white focus:border-purple-500 border-none" type="email" name="email" id="email" placeholder="Email Address"  required autofocus/>
            </div>
						<div class="flex items-center border-2 py-2 px-3 rounded-2xl">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
								fill="currentColor">
								<path fill-rule="evenodd"
									d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
									clip-rule="evenodd" />
							</svg>
							<input class="pl-2 outline-none border-none" type="password" name="password" id="password" placeholder="Password" required />
                        </div>
							<button type="submit" class="block w-full bg-green-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login</button>
		</form>
	</div>
</div></body>
</html>