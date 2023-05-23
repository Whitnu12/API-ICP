<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\jurusan;

class JurusanController extends Controller
{
    public function tampil_jurusan()
    {
        $jurusan = jurusan::all();
        return response()->json(['message' => 'Data jurusan berhasil diambil', 'data' => $jurusan]);
    }

    public function cari_jurusan($id)
    {
        $jurusan = jurusan::findOrFail($id);
        return response()->json(['message' => 'Data jurusan berhasil ditemukan', 'data' => $jurusan]);
    }

    public function tambah_jurusan(Request $request)
    {
    $validatedData = $request->validate([
        'nama_jurusan' => 'required|unique:jurusan,nama_jurusan',
    ]);

    $jurusan = jurusan::create($validatedData);
    return response()->json(['message' => 'Jurusan berhasil ditambahkan', 'data' => $jurusan], 201);
    }

    public function rubah_jurusan(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nama_jurusan' => 'required|unique:jurusan,nama_jurusan,' . $id,
    ]);

    $jurusan = jurusan::findOrFail($id);
    $jurusan->update($validatedData);
    return response()->json(['message' => 'Jurusan berhasil diubah', 'data' => $jurusan], 200);
    }

    public function hapus_jurusan($id)
    {
    $jurusan = jurusan::findOrFail($id);
    $jurusan->delete();
    return response()->json(['message' => 'Jurusan berhasil dihapus'], 204);
    }

    public function getJurusans()
    {
        $jurusans = Jurusan::all();
        return response()->json($jurusans);
    }

    
}
