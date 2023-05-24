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
                    <th class="tableCellMapel">Pengajar</th>
                    <th class="tableCellAction" colspan="2">Action</th> 
                </tr>
            </thead>
            <tbody id="mataPelajaranTableBody" class="border">
                <!-- Data mata pelajaran akan ditambahkan di sini -->
            </tbody>
        </table>

        <div>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 ">
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
                   
        <div class="bg-gray-100 ml-4 p-4 ">
            <h2 class="text-lg font-bold"> Tambah Mata Pelajaran </h2>
            <form id="addMataPelajaranForm">
                @csrf
                <div class="">
                    <label for="namaMapel">Nama Mata Pelajaran</label>
                    <input type="text" id="namaMapel" name="namaMapel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                  <div>
                    <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                    <select id="jurusan" style="width:100%;">
                        <option value="null">Pilih Jurusan</option>
                    </select>
                  </div>
                
                  <div>
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <select id="kelas" style="width:100%;">
                      <option value="null">Pilih Kelas</option>
                    </select>
                  </div>

                  <div>
                    <label for="guru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                    <select id="guru"  style="width:100%;">
                      <option value="null">Pilih guru</option>
                    </select>
                  </div>


                    <button type="submit" id="submitButton" onclick="addMataPelajaran()" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                </form>
        </div>

            </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="bg-gray-100 ml-4 p-4 w-fit">
                        <h2 class="text-lg font-bold"> Update Mata Pelajaran </h2>
                        <form id="updateMataPelajaranForm" method="PUT">
                            @csrf
                            <div class="">
                                <label for="id_2">ID</label>
                                <input type="text" id="id_2" name="id_2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                              </div>
                            <div class="">
                                <label for="nama_mapel_2">Nama Mata Pelajaran</label>
                                <input type="text" id="namaMapel_2" name="namaMapel_2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div>
                              <label for="jurusan_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                              <select id="jurusan_2" style="width:100%;">
                                  <option value="null">Pilih Jurusan</option>
                              </select>
                            </div>
                          
                            <div>
                              <label for="kelas_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                              <select id="kelas_2" style="width:100%;">
                                <option value="null">Pilih Kelas</option>
                              </select>
                            </div>
          
                            <div>
                              <label for="guru_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                              <select id="guru_2"  style="width:100%;">
                                <option value="null">Pilih guru</option>
                              </select>
                            </div>
                                <button type="submit" id="updateButton" onclick="updateMapel($id_2)" class="bg-gray-300 px-10 py-2 mt-4 block">Update</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
{{-- make tab --}}

</div>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
@endsection