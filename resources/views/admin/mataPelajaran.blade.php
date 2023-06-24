<head>
    @vite(['resources/js/mapel.js'])
</head>
@extends('layout.admin_layout')
@section('content')
    <div class=" flex gap-5 justify-between">
        <div>
            <table id="mataPelajaranTable" class=" text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="tableCellid py-2">No</th>
                        {{-- <th class="tableCellid">id</th> --}}
                        <th class="tableCellMapel">Nama Mapel</th>
                        <th class="tableCellid">Jurusan</th>
                        {{-- <th class="tableCellid">Kelas</th> --}}
                        <th class="tableCellMapel">Pengajar</th>
                        <th class="tableCellAction" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="mataPelajaranTableBody">
                    <!-- Data mata pelajaran akan ditambahkan di sini -->
                </tbody>
            </table>
        </div>
        <div class="w-1/3 h-fit ">
            <div class="bg-green-50 px-4 pb-10 rounded-lg">
                <div>
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2  rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Tambah +</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2  rounded-t-lg hover:text-gray-600 hover:border-gray-300 "
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">Update (+)</button>
                            </li>

                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4 rounded-lg bg-white " id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="w-full p-4 ">
                                <h2 class="text-4xl font-medium pb-2"> Tambah Mata Pelajaran </h2>
                                <form id="addMataPelajaranForm">
                                    @csrf
                                    <div class="my-2">
                                        <label for="namaMapel">Nama Mata Pelajaran</label>
                                        <input type="text" id="namaMapel" name="namaMapel"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div>
                                        <label for="jurusan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                                        <select id="jurusan" style="width:100%;">
                                            <option value="null">Pilih Jurusan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="guru"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengajar</label>
                                        <select id="guru" style="width:100%;" multiple>
                                            <option value="null">Pilih guru</option>
                                        </select>
                                    </div>


                                    <button type="submit" id="submitButton" onclick="addMataPelajaran()"
                                        class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                                </form>
                            </div>

                        </div>
                        <div class="hidden p-4 rounded-lg bg-white " id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="p-4 w-full">
                                <h2 class="text-4xl font-medium pb-2"> Update Mata Pelajaran </h2>
                                <form id="updateMataPelajaranForm" method="PUT">
                                    @csrf
                                    <div class="">
                                        <label for="id_2">ID</label>
                                        <input type="text" id="id_2" name="id_2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight "
                                            readonly>
                                    </div>
                                    <div class="my-2">
                                        <label for="namaMapel2">Nama Mata Pelajaran</label>
                                        <input type="text" id="namaMapel2" name="namaMapel2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div>
                                        <label for="jurusan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                                        <select id="jurusan2" style="width:100%;">
                                            <option value="null">Pilih Jurusan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="guru"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengajar</label>
                                        <select id="guru2" style="width:100%;" multiple>
                                            <option value="null">Pilih guru</option>
                                        </select>
                                    </div>
                                    <button type="submit" id="updateButton" onclick="updateMapel($id_2)"                                        class="bg-gray-300 px-10 py-2 mt-4 block">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- make tab --}}

            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
