@extends('layout.admin_layout')
@section('content')
    <div class="mb-4">
        <h1 class="text-xl font-bold ">Pengembangan Sosial</h1>
        <h3 class="text-l text-gray-600 ">Tugas 1</h3>
    </div>
    <div class=" flex gap-5">
        <div>
            <table id="mataPelajaranTable" class=" text-sm text-center text-gray-500">
                <thead class="text-s text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="tableCellid py-2">No</th>
                        {{-- <th class="tableCellid">id</th> --}}
                        <th class="tableCellMapel px-40 ">NIS </th>
                        <th class="tableCellid px-40 ">Nama Siswa</th>
                        {{-- <th class="tableCellid">Kelas</th> --}}
                        <th class="tableCellAction px-10">Nilai Siswa</th>
                    </tr>
                </thead>
                <tbody id="mataPelajaranTableBody">
                    <!-- Data mata pelajaran akan ditambahkan di sini -->
                    <tr class="hover:bg-gray-100 bg-grey-100 ">
                        <td class="tableCellMapel ">1</td>
                        <td class="tableCellMapel">17415</td>
                        <td class="tableCellMapel">Adimas</td>
                        <td class="tableCellMapel">80</td>
                    </tr>
                    <tr class="hover:bg-gray-100 bg-grey-100 ">
                        <td class="tableCellMapel ">2</td>
                        <td class="tableCellMapel">17416</td>
                        <td class="tableCellMapel">AIS ANGGRIANI</td>
                        <td class="tableCellMapel">76</td>
                    </tr>
                    <tr class="hover:bg-gray-100 bg-grey-100 ">
                        <td class="tableCellMapel ">3</td>
                        <td class="tableCellMapel">17417</td>
                        <td class="tableCellMapel">AL FARIJA</td>
                        <td class="tableCellMapel">77</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
