<head>
    
</head>

@extends('layout.admin_layout')
@section('content')
    <div class="flex gap-2 justify-between">
        <div>
            <table id="guruTable" class="text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="py-3 tableCellid">No</th>
                        {{-- <th class="px-2 tableCellid">id</th> --}}
                        <th class="tableCellMapel">Mata Pelajaran</th>
                        <th class="tableCellMapel">Guru</th>
                        <th class="tableCellMapel">Capaian Jam</th>
                        <th class="tableCellAction" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="guruBody">
                    <!-- Data guru akan ditambahkan di sini -->
                    <tr>
                        <td class="tableCellMapel"> 1 </td>
                        <td class="tableCellMapel"> Pendidikan Agama Islam </td>
                        <td class="tableCellMapel"> Budi </td>
                        <td class="tableCellMapel">
                            <div class="w-56">
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: 45%"> 45/100</div>
                                </div>
                            </div>
                        </td>
                        <td colspan="2" class="tableCellAction">Action</td>
                    </tr>
                    <tr>
                        <td class="tableCellMapel"> 1</td>
                        <td class="tableCellMapel"> Pendidikan Agama Islam </td>
                        <td class="tableCellMapel"> Yanto </td>
                        <td class="tableCellMapel">
                            <div class="w-56">
                                <div class="w-full bg-gray-200 rounded-full">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: 65%"> 65/100</div>
                                </div>
                            </div>
                        </td>
                        <td colspan="2" class="tableCellAction">Action</td>

                    </tr>
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
                                <h2 class="text-2xl font-medium pb-2"> Tambah Capaian Jam Belajar </h2>
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


                                    <button type="submit"
                                        class="bg-green-400 text-white text-lg px-10 py-2 mt-4 block w-full ">Tambah</button>
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
                                        <label for="id_mengajar2"> ID </label>
                                        <input type="text" id="id_mengajar2" name="id_kelas2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            readonly>
                                    </div>
                                    <div class="my-2">
                                        <label for="kelas2">Kelas </label>
                                        <Select id="kelas2" style="width:100%;">
                                        </Select>
                                    </div>
                                    <div class="my-2">
                                        <label for="nama_mapel2"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Mata
                                            Pelajaran</label>
                                        <select id="nama_mapel2" style="width:100%;">
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="hari2"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Hari</label>
                                        <select id="hari2" style="width:100%;">
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
                                        <label for="guru2"> Pengajar </label>
                                        <select type="text" id="guru2" style="width: 100%"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="jam_mulai2"> mulai kelas (jam) </label>
                                        <input type="time" id="jam_mulai2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="my-2">
                                        <label for="jam_belaja2r"> Bobot jam belajar </label>
                                        <input type="number" id="jam_belajar2"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <button type="submit"
                                        class="bg-green-400 text-white text-lg px-10 py-2 mt-4 block w-full ">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
