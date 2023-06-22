<head>
    @vite(['resources/js/ptk.js'])
</head>
@extends('layout.admin_layout')
@section('content')
    <div class=" flex gap-5 justify-between">
        <div>
            <table id="guruTable" class=" text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="tableCellid py-3">No</th>
                        {{-- <th class="tableCellid px-2">id</th> --}}
                        <th class="tableCellMapel">NPP</th>
                        <th class="tableCellMapel">Nama</th>
                        <th class="tableCellMapel">Email</th>
                        <th class="tableCellMapel">Jabatan</th>
                        <th class="tableCellAction" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="guruBody">
                    <!-- Data guru akan ditambahkan di sini -->
                </tbody>
            </table>
        </div>

        <div class="w-1/2 h-fit ">
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
                        <div class="hidden p-4 rounded-lg bg-white" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class=" p-4 w-full">
                                <h2 class="text-4xl font-medium pb-2"> Registrasi Guru </h2>
                                <form id="tambahGuru">
                                    @csrf
                                    <div class="my-2">
                                        <label for="nama">Nama PTK </label>
                                        <input type="text" id="nama" name="nama"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="my-2"> <label for="NPP">NIP</label>
                                        <input type="text" id="NPP" name="NPP"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="my-2"> <label for="email">Email address </label>
                                        <input type="email" id="email" name="email"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="my-2">
                                        <label for="jabatan">Jabatan</label>
                                        <select id="jabatan"
                                            class=" border bg-white border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="guru"> Guru</option>
                                            <option value="tenaga_kependidikan">tenaga kependidikan</option>
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password"
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
                                <h2 class="text-4xl font-medium pb-2"> Update Data Guru</h2>
                                <form id="rubahGuru">
                                    @csrf
                                    <div class="my-2">
                                        <label for="">ID</label>
                                        <input type="text" id="id_2" name="id"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight "
                                            readonly>
                                    </div>
                                    <div class="">
                                        <label for="nama">Nama </label>
                                        <input type="text" id="nama_2" name="nama"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="">
                                        <label for="NPP">NPP</label>
                                        <input type="text" id="npp_2" name="NPP"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="">
                                        <label for="email">email</label>
                                        <input type="email" id="email_2" name="email"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="">
                                        <label for="jabatan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                                        <select id="jabatan_2"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="guru"> Guru</option>
                                            <option value="tenaga_kependidikan">Tenaga kependidikan</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <label for="password">Password</label>
                                        <input type="password" id="password_2" name="password"
                                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <button type="submit" id="submitButton"
                                        class="bg-green-400 text-white text-lg px-10 py-2 mt-4 block w-full ">Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
