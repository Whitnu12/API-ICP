<head>
    @vite(['resources/js/kelas.js'])
</head>

@extends('layout.admin_layout')
@section('content')
<h1>konfigurasi data kelas disini</h1>
<body>
<div class="container flex space-x-32">
    <table id="kelasTable" class="table-auto">
        <thead>
            <tr>
                <th class="tableCellid">No</th>
                <th class="tableCellid">id</th>
                <th class="tableCellMapel">kelas</th>
                <th class="tableCellMapel">jumlah Murid</th>
                <th class="tableCellMapel">jurusan</th>
                <th class="tableCellMapel">angkatan</th>
                <th class="tableCellAction" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody id="kelasBody" class="border">

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
        <h2 class="text-lg font-bold"> Tambah Kelas </h2>
        <form id="tambahKelas">
            @csrf
            <div class="">
                <label for="nama">Kelas </label>
                <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="">
                <label for="NPP">Jumlah Murid</label>
                <input type="text" id="NPP" name="NPP" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                <select id="jurusan" style="width:100%;">
                </select>
              </div>
            <div class="">
                <label for="NPP">Angkatan</label>
                <select name="angkatan" id="tahunDropdown" style="width: 100%;">
                    <option value="null">Pilih Angkatan</option>
                </select>            
            </div>
                <button type="submit" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
            </form>
        </div>
        </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="bg-gray-100 ml-4 p-4 w-fit">
                    <h2 class="text-lg font-bold"> Rubah Data Guru</h2>
                    <form id="rubahGuru">
                        @csrf
                        <div class="">
                            <label for="">ID</label>
                            <input type="text" id="id_2" name="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                        </div>
                        <div class="">
                            <label for="nama">Nama </label>
                            <input type="text" id="nama_2" name="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="">
                            <label for="NPP">NPP</label>
                            <input type="text" id="npp_2" name="NPP" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
            
                        <div class="">
                            <label for="email">email</label>
                            <input type="email" id="email_2" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
            
                       <div class="">
                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>        
                            <select id="jabatan_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="guru"> Guru</option> 
                                <option value="tenaga kependidikan">tenaga kependidikan</option> 
                            </select>
                        </div>           
                        <div class="">
                            <label for="password">Password</label>
                            <input type="password" id="password_2" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                            <button type="submit" id="submitButton" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
@endsection