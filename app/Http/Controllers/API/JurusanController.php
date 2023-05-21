<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    public function tampil_jurusan()
    {
        $jurusan = Jurusan::all();
        return response()->json($jurusan);
    }

    public function cari_jurusan($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return response()->json($jurusan);
    }

    public function tambah_jurusan(Request $request)
    {
    $validatedData = $request->validate([
        'nama_jurusan' => 'required|unique:jurusan,nama_jurusan',
    ]);

    $jurusan = Jurusan::create($validatedData);
    return response()->json($jurusan, 201);
    }

    public function rubah_jurusan(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nama_jurusan' => 'required|unique:jurusan,nama_jurusan,' . $id,
    ]);

    $jurusan = Jurusan::findOrFail($id);
    $jurusan->update($validatedData);
    return response()->json($jurusan, 200);
    }

    public function hapus_jurusan($id)
    {
    $jurusan = Jurusan::findOrFail($id);
    $jurusan->delete();
    return response()->json(null, 204);
    }



    
}
