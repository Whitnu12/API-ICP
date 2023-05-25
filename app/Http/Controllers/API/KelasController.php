<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return response()->json(['message' => 'Data kelas berhasil diambil', 'data' => $kelas]);

    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json(['message' => 'Data kelas berhasil diambil', 'data' => $kelas]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'id_jurusan' => 'required',
            'jumlahMurid' => 'required',
            'angkatan' => 'required',
        ]);

        $kelas = Kelas::create($validatedData);
        return response()->json(['message' => 'Data kelas berhasil ditambah', 'data' => $kelas],201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id,
            'id_jurusan' => 'required|sometimes',
            'jumlahMurid' => 'required|sometimes',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validatedData);
        return response()->json(['message' => 'Data kelas berhasil dirubah', 'data' => $kelas],200);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json(['message' => 'Data kelas berhasil dihapus', 'data' => $kelas]);
    }

}
