<head>
    @vite(['resources/js/laporan.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
@extends('layout.admin_layout')
@section('content')
    <div class="flex gap-1 justify-between">
        <div>
            <table id="laporanTable" class="table-auto text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="tableCellid">No</th>
                        <th class="tableCellMapel">Tanggal</th>
                        <th class="tableCellid">Nama Pengirim</th>
                        <th class="tableCellMapel">Nama Laporan</th>
                        <th class="tableCellMapel">Jenis Laporan</th>
                    </tr>
                </thead>
                <tbody id="laporanBody">
                </tbody>
            </table>
        </div>

        <div class="w-1/2 h-fit">
            <div class="bg-green-50 px-4 py-10 rounded-lg">
                <div class="flex justify-between pb-6">
                    <div class="w-2/3">
                        <h1 class="font-bold"> Nama kegiatan</h1>
                        <h1 class="text-xl" id="nama-kegiatan"> </h1>
                    </div>
                    <div>
                        <h1 class="font-bold"> Tanggal kegiatan</h1>
                        <h1 class="text-xl" id="tanggal-kegiatan"> </h1>
                    </div>
                </div>
                <div class="my-2">
                    <h1 class=" font-bold"> Nama Pengirim</h1>
                    <h1 class="text-xl" id="nama-pengirim">
                    </h1>
                </div>
                <div class="my-2">
                    <h1 class="font-bold"> Jenis Laporan</h1>
                    <h1 class="text-xl" id="jenis-laporan"> </h1>
                </div>
                <div class="my-2">
                    <h1 class="text-2xl font-bold"> Deskripsi Laporan</h1>
                    <h1 id="deskripsi-laporan">
                    </h1>
                </div>
                <div id="modal"
                    class="hidden fixed z-50  mx-auto left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-50">
                    <span class="text-white absolute top-2 right-56 text-4xl font-bold cursor-pointer"
                        id="close">&times;</span>
                    <img id="modal-image" class="block max-w-xl max-h-xl mx-auto my-auto " src="" alt="Modal Image">
                </div>
                <div class="grid grid-cols-2 gap-3" id="gallery">

                </div>
                <div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
