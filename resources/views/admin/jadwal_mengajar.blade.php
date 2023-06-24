<head>
    @vite(['resources/js/mengajar.js'])
</head>

@extends('layout.admin_layout')
@section('content')
    <div class="flex gap-5 justify-between">
        <div>
            <table id="mengajarTable" class=" text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="tableCellid py-2">No</th>
                        <th class="tableCellMapel">Mata Pelajaran</th>
                        <th class="tableCellMapel">Kelas</th>
                        <th class="tableCellMapel">Pengajar</th>
                        <th class="tableCellMapel">Hari</th>
                        <th class="tableCellMapel">Mulai</th>
                        <th class="tableCellMapel">Selesai</th>
                        <th class="tableCellMapel">Jam belajar</th>
                        <th class="tableCellAction" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="mengajarBody">

                </tbody>
            </table>
        </div>
        <div class="w-1/3 h-fit">
            <div class="bg-green-50 px-4 pb-10 rounded-lg">

                <div>
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Tambah +</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2  rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">Update (+)</button>
                            </li>

                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4 rounded-lg bg-white " id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class=" p-4 w-full">
                                <h2 class="text-4xl font-medium pb-2"> Tambah Kelas </h2>
                                <form id="tambahMengajar">
                                    @csrf
                                    <div class="my-2">
                                        <label for="kelas">Kelas </label>
                                        <Select id="kelas" style="width:100%;">
                                        </Select>
                                    </div>
                                    <div class="my-2">
                                        <label for="nama_mapel" class="block mb-2 text-sm font-medium text-gray-900 ">Mata
                                            Pelajaran</label>
                                        <select id="nama_mapel" style="width:100%;">
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="hari"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Hari</label>
                                        <select id="hari" style="width:100%;">
                                            <option value="null"> Pilih Hari </option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jum'at</option>
                                            <option value="sabtu">Sabtu</option>
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="guru"> Pengajar </label>
                                        <select type="text" id="guru" style="width: 100%"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="jam_mulai"> mulai kelas (jam) </label>
                                        <input type="time" id="jam_mulai"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="my-2">
                                        <label for="jam_belajar"> Bobot jam belajar </label>
                                        <input type="number" id="jam_belajar"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>


                                    <button type="submit" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                                </form>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-white" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="  p-4 w-full">
                                <h2 class="text-4xl font-medium pb-2"> Rubah Kelas</h2>
                                <form id="rubahMengajar">
                                    @csrf
                                    <div class="my-2">
                                        <label for="id_kelas2"> ID </label>
                                        <input type="text" id="id_kelas2" name="id_kelas2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            readonly>
                                    </div>
                                    <div class="my-2">
                                        <label for="kelas">Kelas </label>
                                        <Select id="kelas_2" style="width:100%;">
                                            <option value="null">Pilih Kelas</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </Select>
                                    </div>
                                    <div class="my-2">
                                        <label for="jurusan2"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Jurusan</label>
                                        <select id="jurusan2" style="width:100%;">
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="nama_kelas2"> Nama Kelas (A/B/1/2) </label>
                                        <input type="text" id="nama_kelas2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </label>
                                    </div>
                                    <div class="my-2">
                                        <label for="kode_kelas2"> Kode Kelas </label>
                                        <input type="text" id="kode_kelas2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            readonly>
                                    </div>
                                    <button type="submit" class="bg-gray-300 px-10 py-2 mt-4 block">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
