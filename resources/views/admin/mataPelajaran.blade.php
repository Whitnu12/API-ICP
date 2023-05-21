@extends('layout.admin_layout')
@section('content')
<body>
<div class="container flex space-x-64">
        <table id="mataPelajaranTable"class="table-auto">
            <thead>
                <tr>
                    <th class="tableCellid">No</th>
                    <th class="tableCellid">id</th>
                    <th class="tableCellMapel">Nama Mata Pelajaran</th>
                    <th class="tableCellid" >Jurusan</th>
                    <th class="tableCellid" >Kelas</th>
                    <th class="tableCellAction" colspan="2">Action</th>
                    
                </tr>
            </thead>
            <tbody id="mataPelajaranBody" class="border">
                <!-- Data mata pelajaran akan ditambahkan di sini -->
            </tbody>
        </table>

        <div>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tambah +</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Update (+)</button>
                    </li>
                    
                </ul>
            </div>
            <div id="myTabContent">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                   
        <div class="bg-gray-100 ml-4 p-4 w-fit">
            <h2 class="text-lg font-bold"> Tambah Mata Pelajaran </h2>
            <form id="addMataPelajaranForm">
                @csrf
                <div class="">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                  </div>
                <div class="">
                    <label for="namaMapel">Nama Mata Pelajaran</label>
                    <input type="text" id="namaMapel" name="namaMapel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="">
                    <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>        
                    <select id="jurusan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null" > Pilih Jurusan</option>
                    </select>
                </div>
                <div>
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>                   
                    <select id="kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">Pilih kelas</option>
                      </select>             
                    </div>
                    <button type="submit" id="submitButton" onclick="addMataPelajaran()" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                </form>
        </div>

                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="bg-gray-100 ml-4 p-4 w-fit">
                        <h2 class="text-lg font-bold"> Update Mata Pelajaran </h2>
                        <form id="updateMataPelajaranForm" method="PUT" onsubmit="updateMapel(document.getElementById('id-2').value)">
                            @csrf
                            <div class="">
                                <label for="id_2">ID</label>
                                <input type="text" id="id_2" name="id_2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                              </div>
                            <div class="">
                                <label for="nama_mapel_2">Nama Mata Pelajaran</label>
                                <input type="text" id="namaMapel_2" name="namaMapel_2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="">
                                <label for="jurusan_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>        
                                <select id="jurusan_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    {{-- <option value="null" > Pilih Jurusan</option> --}}
                                </select>
                            </div>
                            <div>
                                <label for="kelas_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>                   
                                <select id="kelas_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    {{-- <option value="null">Pilih kelas</option> --}}
                                  </select>             
                                </div>
                                <button type="submit" id="updateButton"s class="bg-gray-300 px-10 py-2 mt-4 block">Update</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
{{-- make tab --}}
</div>  



<script>  

    function showAlert(message) {
        const alertElement = document.getElementById('toast-alert');
        const messageElement = document.getElementById('pesan');
        messageElement.textContent = message;

        alertElement.classList.remove('invisible');
        alertElement.classList.add('visible');

        setTimeout(() => {
            alertElement.classList.remove('visible');
            alertElement.classList.add('invisible');
        }, 3000);
    }

    // function updateMapel(id){
    //     fetch(`http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/${id}`{
    //         method : 'PUT'
    //         headers{
    //             'Content-Type' : 'application/json'
    //         }
    //         body : JSON.stringify(data)
    //     })

    //     .then(response => {
    //         if(response.ok){
    //             showAlert('Mata pelajaran berhasil diupdate');
    //             console.log('Mata pelajaran berhasil diupdate');
    //             getDataMataPelajaran();
    //         }else{
    //             showAlert('Gagal mengupdate mata pelajaran');
    //             console.error('Gagal mengupdate mata pelajaran');
    //         }
    //     })
    //     catch(error => {
    //         showAlert('Terjadi kesalahan');
    //         console.error('Terjadi kesalahan:', error);
    //     })
    // }

// Event listener untuk menghandle submit form penambahan mata pelajaran
    function addMataPelajaran(data) {
        fetch('http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/add', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => {
            if (response.ok) {
                // Tampilkan pesan sukses
                showAlert('Mata pelajaran berhasil ditambahkan');
                console.log('Mata pelajaran berhasil ditambahkan');
                getDataMataPelajaran();
            } else {
                // Tampilkan pesan error
                showAlert('Gagal menambahkan mata pelajaran');
                console.error('Gagal menambahkan mata pelajaran');
            }
            })
            .catch(error => {
            // Tampilkan pesan error
            showAlert('Terjadi kesalahan');
            console.error('Terjadi kesalahan:', error);
            });
        }

            addMataPelajaranForm.addEventListener('submit', event => {
            event.preventDefault();

            const namaMapel = document.getElementById('namaMapel').value;
            const jurusan = document.getElementById('jurusan').value;
            const kelas = document.getElementById('kelas').value;

            const newData = {
                nama_mapel: namaMapel,
                jurusan: jurusan,
                kelas: kelas,
            };

            addMataPelajaran(newData);
            addMataPelajaranForm.reset();
        });

        Promise.all([
            fetch('http://192.168.100.6/laravel-icp2/public/api/jurusan'),
            fetch('http://192.168.100.6/laravel-icp2/public/api/kelas')
            ])
            .then(responses => Promise.all(responses.map(response => response.json())))
            .then(data => {
                const jurusanSelect = document.getElementById('jurusan');
                const kelasSelect = document.getElementById('kelas');
                const jurusanSelect2 = document.getElementById('jurusan_2');
                const kelasSelect2 = document.getElementById('kelas_2');

                data[0].jurusan.forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan;
                option.text = jurusan;
                jurusanSelect.appendChild(option);
                });

                data[1].kelas.forEach(kelas => {
                const option = document.createElement('option');
                option.value = kelas;
                option.text = kelas;
                kelasSelect.appendChild(option);
                });

                data[0].jurusan.forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan;
                option.text = jurusan;
                jurusanSelect2.appendChild(option);
                });

                data[1].kelas.forEach(kelas => {
                const option = document.createElement('option');
                option.value = kelas;
                option.text = kelas;
                kelasSelect2.appendChild(option);
                });
        });
                
        // Fungsi untuk menghapus mata pelajaran
        function deleteMapel(id) {
            fetch(`http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/${id}`, {
                method: 'DELETE',
                headers: {
                }
            })
                .then(response => {
                if (response.ok) {
                    // Tampilkan pesan sukses
                    getDataMataPelajaran(); // Memperbarui tabel setelah berhasil menambahkan mata pelajaran
                    showAlert('Mata pelajaran berhasil dihapus');
                    console.log('Mata pelajaran berhasil dihapus');
                } else {
                    // Tampilkan pesan error
                    showAlert('Gagal menghapus mata pelajaran');
                    console.error('Gagal menghapus mata pelajaran');
                }
                })
                .catch(error => {
                // Tampilkan pesan error
                showAlert('Terjadi kesalahan');
                console.error('Terjadi kesalahan:', error);
                });
            }

            //Fungsi untuk memperbarui mata pelajaran
            function updateMapel(id) {
                const namaMapel = document.getElementById('nama_mapel-2').value;
                const jurusan = document.getElementById('jurusan-2').value;
                const kelas = document.getElementById('kelas-2').value;

                const data = {
                    nama_mapel: namaMapel,
                    jurusan: jurusan,
                    kelas: kelas
                };

                fetch(`http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/update/${id}`, {
                    method: 'PUT',
                    headers: {
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                    if (response.ok) {
                        // Tampilkan pesan sukses
                        showAlert('Data berhasil diperbarui');
                        console.log('Data berhasil diperbarui');
                    } else {
                        // Tampilkan pesan error
                        showAlert('Gagal memperbarui data');
                        console.error('Gagal memperbarui data');
                    }
                    })
                    .catch(error => {
                    // Tampilkan pesan error
                    showAlert('Terjadi kesalahan');
                    console.error('Terjadi kesalahan:', error);
                    });
                }

    // Fungsi untuk mendapatkan data mata pelajaran dari API dan mengisi tabel
    function getDataMataPelajaran() {
        fetch('http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran')
            .then(response => response.json())
            .then(data => {
            // Menghapus semua baris yang ada di dalam tbody
            mataPelajaranBody.innerHTML = '';

            // Mengisi tabel dengan data mata pelajaran
            data.forEach((mataPelajaran, index) => {
                // Membuat elemen-elemen untuk setiap kolom data
                const row = document.createElement('tr');

                // Kolom No
                const noCell = document.createElement('td');
                noCell.classList.add('tableCellid');
                noCell.textContent = index + 1;
                row.appendChild(noCell);

                const idCell = document.createElement('td');
                idCell.classList.add('tableCellid');
                idCell.textContent = mataPelajaran.id;
                row.appendChild(idCell);

                // Kolom Nama Mata Pelajaran
                const namaMapelCell = document.createElement('td');
                namaMapelCell.classList.add('tableCellMapel');
                namaMapelCell.textContent = mataPelajaran.nama_mapel;
                row.appendChild(namaMapelCell);

                // Kolom Jurusan
                const jurusanCell = document.createElement('td');
                jurusanCell.classList.add('tableCellJurusan');
                jurusanCell.textContent = mataPelajaran.jurusan;
                row.appendChild(jurusanCell);

                // Kolom Kelas
                const kelasCell = document.createElement('td');
                kelasCell.classList.add('tableCellKelas');
                kelasCell.textContent = mataPelajaran.kelas;
                row.appendChild(kelasCell);

                // Kolom Action - Tombol Delete
                const deleteCell = document.createElement('td');
                deleteCell.classList.add('tableCellAction');
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.addEventListener('click', () => {
                deleteMapel(mataPelajaran.id);
                });
                deleteCell.appendChild(deleteButton);
                row.appendChild(deleteCell);

                // Kolom Action - Tombol Update
                const updateCell = document.createElement('td');
                updateCell.classList.add('tableCellAction');
                const updateButton = document.createElement('button');
                updateButton.textContent = 'Update';
                updateButton.addEventListener('click', () => {
                // Mengisi nilai form dengan data mata pelajaran yang akan diperbarui
                document.getElementById('namaMapel_2').value = mataPelajaran.nama_mapel;
                document.getElementById('jurusan_2').value = mataPelajaran.jurusan;
                document.getElementById('kelas_2').value = mataPelajaran.kelas;
                document.getElementById('id_2').value = mataPelajaran.id;

                });
                updateCell.appendChild(updateButton);
                row.appendChild(updateCell);

                // Menambahkan event listener untuk pemilihan baris mata pelajaran
                row.addEventListener('click', () => {
                const rows = document.querySelectorAll('.tableRow');
                rows.forEach(row => {
                    row.classList.remove('selected');
                });
                row.classList.add('selected');
                });

                // Menambahkan baris ke dalam tbody
                mataPelajaranBody.appendChild(row);
            });

            // Menampilkan tabel jika terdapat data mata pelajaran
            mataPelajaranTable.style.display = data.length > 0 ? 'table' : 'none';
            })
            .catch(error => console.error('Error:', error));
        }

    
    
        function fillOptions(selectElement, dataArray) {
        selectElement.innerHTML = ""; // Menghapus opsi sebelumnya

        // Membuat opsi kosong dengan nilai "null"
        const nullOption = document.createElement("option");
        nullOption.value = "null";
        nullOption.textContent = "Pilih...";
        selectElement.appendChild(nullOption);

        // Membuat opsi sesuai dengan nilai dari dataArray
        dataArray.forEach(data => {
            const option = document.createElement("option");
            option.value = data;
            option.textContent = data;
            selectElement.appendChild(option);
        });
    }
    
    // Memanggil fungsi untuk mendapatkan dan menampilkan data mata pelajaran saat halaman dimuat
    getDataMataPelajaran();
    
    </script>
    
</body>
@endsection