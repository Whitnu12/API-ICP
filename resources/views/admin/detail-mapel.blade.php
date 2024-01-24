@extends('layout.admin_layout')
@section('content')
    <div class="mb-4">
        <h1 class="text-3xl font-bold">IPAS - X TKJ 1</h1>
        <h2 class="text-gray-500">Feriyati,S.Pd</h2>
    </div>
    <div class="flex gap-20 ">
        <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">

                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Tugas</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Judul Tugas
                                </p>
                            </div>
                            <div class="inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                Nilai rata-rata
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4 hover:bg-gray-100">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Pengembangan Sosial
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Tugas 1
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                89
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>


        <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Kuis</h5>

            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Judul Kuis
                                </p>
                            </div>
                            <div class="inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                Nilai rata-rata
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <a href="{{ route('informasi-nilai-kuis') }}" class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Pengembangan Sosial
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Kuis 1
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                89
                            </div>
                        </a>
                    </li>
                    <li class="py-3 sm:py-4 hover:bg-gray-100">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Tanaman dan Pertumbuhan
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Kuis 2
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                80
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


    </div>



    <div class="relative overflow-x-auto mt-10">
        <h1 class="text-xl font-bold mb-5"> Presensi Siswa</h1>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NIS
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Siswa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hadir
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sakit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Izin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alpa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bolos
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        1
                    </th>
                    <td class="px-6 py-4">
                        17415
                    </td>
                    <td class="px-6 py-4">
                        Adimas
                    </td>
                    <td class="px-6 py-4">
                        10
                    </td>
                    <td class="px-6 py-4">
                        2
                    </td>
                    <td class="px-6 py-4">
                        1
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                </tr>

                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        2
                    </th>
                    <td class="px-6 py-4">
                        17416
                    </td>
                    <td class="px-6 py-4">
                        Ais Anggriani
                    </td>
                    <td class="px-6 py-4">
                        10
                    </td>
                    <td class="px-6 py-4">
                        1
                    </td>
                    <td class="px-6 py-4">
                        2
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                </tr>

                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        3
                    </th>
                    <td class="px-6 py-4">
                        17417
                    </td>
                    <td class="px-6 py-4">
                        Al Farija
                    </td>
                    <td class="px-6 py-4">
                        8
                    </td>
                    <td class="px-6 py-4">
                        2
                    </td>
                    <td class="px-6 py-4">
                        3
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                    <td class="px-6 py-4">
                        0
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        4
                    </th>
                    <td class="px-6 py-4">
                        17418
                    </td>
                    <td class="px-6 py-4">
                        Al Usri
                    </td>
                    <td class="px-6 py-4">
                        9
                    </td>
                    <td class="px-6 py-4">
                        1
                    </td>
                    <td class="px-6 py-4">
                        1
                    </td>
                    <td class="px-6 py-4">
                        2
                    </td>
                    <td class="px-6 py-4">
                        1
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
