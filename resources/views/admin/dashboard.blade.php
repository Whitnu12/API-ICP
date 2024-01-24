@extends('layout.admin_layout')
@section('content')
    @if (Auth::guard('user')->check())
        <h2 class="text-xl">Welcome, {{ Auth::guard('user')->user()->name }}</h2>
    @endif
    <div class=" grid grid-cols-3 gap-10">
        {{-- <a href="{{ route('ptk') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Pendidik dan Tenaga Kependidikan
            </h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\guru::count() }}</p>
        </a> --}}
        {{-- <a href="{{ route('kelas') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kelas</h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\kelas::count() }}</p>
        </a> --}}

        <a href="{{ route('mapel') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mata Pelajaran</h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\MataPelajaran::count() }}</p>
        </a>
        <a href="{{ route('mapel') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Siswa</h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\Siswa::count() }}</p>
        </a>
        <a href="{{ route('mapel') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Siswa</h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\guru::count() }}</p>
        </a>
        {{-- <a href="{{ route('laporan') }}"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Laporan</h5>
            <p class="font-normal text-5xl text-gray-700">{{ \App\Models\laporan::count() }}</p>
        </a> --}}
    </div>
@endsection
