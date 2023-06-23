<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kelas;
use Illuminate\Support\Facades\Validator;


class KelasController extends Controller
{
    public function index()
    {
        $kelas = kelas::all();
        return response()->json(['message' => 'Data kelas berhasil diambil', 'data' => $kelas]);

    }

    public function show($id)
    {
        $kelas = kelas::findOrFail($id);
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
    $kelas = kelas::find($id);
    if (!$kelas) {
        return response()->json(['message' => 'Data kelas tidak ditemukan'], 404);
    }

    $validator = Validator::make($request->all(), [
        'nama_kelas' => 'required|sometimes',
        'id_jurusan' => 'required|sometimes',
        'jumlahMurid' => 'required|sometimes',
        'angkatan' => 'required|sometimes',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Data kelas gagal diubah', 'data' => $validator->errors()], 400);
    }

    $kelas->nama_kelas = $request->input('nama_kelas', $kelas->nama_kelas);
    $kelas->id_jurusan = $request->input('id_jurusan', $kelas->id_jurusan);
    $kelas->jumlahMurid = $request->input('jumlahMurid', $kelas->jumlahMurid);
    $kelas->angkatan = $request->input('angkatan', $kelas->angkatan);
    $kelas->save();

    return response()->json(['message' => 'Data kelas berhasil dirubah', 'data' => $kelas], 200);
}

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json(['message' => 'Data kelas berhasil dihapus', 'data' => $kelas]);
    }

}
