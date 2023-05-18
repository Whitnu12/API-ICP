<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script>
        function handleLoginResponse(response) {
            if (response.message === 'success') {
                // Pengalihan halaman ke dashboard
                window.location.href = "{{ route('admin.dash') }}";
            } else {
                // Tampilkan pesan error jika login tidak berhasil
                alert(response.message);
            }
        }
    </script>
</head>
<body>
    <h2>Login</h2>

    <form 
    method="POST" 
    action="{{ route('admin.login') }}" onsubmit="event.preventDefault(); loginUser(this);">
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
    </form>

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
</body>
</html>