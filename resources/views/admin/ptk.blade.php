<head>
    @vite(['resources/js/ptk.js'])
</head>
@extends('layout.admin_layout')
@section('content')
    <div class="flex justify-between gap-5 ">
        <div>
            <table id="guruTable" class="text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="py-3 tableCellid">No</th>
                        {{-- <th class="px-2 tableCellid">id</th> --}}
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

        <div class="w-1/3 h-fit">
            <div class="px-4 pb-10 rounded-lg bg-green-50">
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
                                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 "
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">Update (+)</button>
                            </li>

                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4 bg-white rounded-lg" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="w-full p-4 ">
                                <h2 class="pb-2 text-4xl font-medium"> Registrasi Guru </h2>
                                <form id="tambahGuru">
                                    @csrf
                                    <div class="my-2">
                                        <label for="nama">Nama PTK </label>
                                        <input type="text" id="nama" name="nama"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="my-2"> <label for="NPP">NIP</label>
                                        <input type="text" id="NPP" name="NPP" maxlength="18"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="my-2"> <label for="email">Email address </label>
                                        <input type="email" id="email" name="email"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
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
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>
                                    <button type="submit"
                                        class="block w-full px-10 py-2 mt-4 text-lg text-white bg-green-400"
                                        id="tambahButton">Tambah</button>
                                </form>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="w-full p-4 ">
                                <h2 class="pb-2 text-4xl font-medium"> Update Data Guru</h2>
                                <form id="rubahGuru">
                                    @csrf
                                    <div class="my-2">
                                        <label for="">ID</label>
                                        <input type="text" id="id_2" name="id"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none "
                                            readonly>
                                    </div>
                                    <div class="">
                                        <label for="nama">Nama </label>
                                        <input type="text" id="nama_2" name="nama"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="">
                                        <label for="NPP">NPP</label>
                                        <input type="text" id="npp_2" name="NPP"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="">
                                        <label for="email">email</label>
                                        <input type="email" id="email_2" name="email"
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
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
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border-none rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    </div>
                                    <button type="submit" id="submitButton"
                                        class="block w-full px-10 py-2 mt-4 text-lg text-white bg-green-400 ">Update
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
