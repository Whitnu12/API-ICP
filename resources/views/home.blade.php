@extends('layout.admin_layout')
@section('content')

<h1>mantap bro</h1>

<script>
    // Fetch data dari API
    fetch('/api/user/admin', {
        headers: {
            'Authorization': 'Bearer ' + '{{ session('user')->token }}'
        }
    })
        .then(response => response.json())
        .then(data => {
            // Memperoleh data user admin
            const adminData = data.data.admin;

            // Menampilkan data pada halaman
            const adminName = document.createElement('h2');
            adminName.textContent = 'Admin Name: ' + adminData.nama;
            document.getElementById('admin-info').appendChild(adminName);
        })
        .catch(error => console.error('Error:', error));
</script>

@endsection