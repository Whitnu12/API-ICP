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
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'nama_kelas' => 'required',
            'id_jurusan' => 'required',
            'kode_kelas' => 'required|unique:kelas,kode_kelas'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $kelas = kelas::create($request->all());
        return response()->json(['message' => 'Data kelas berhasil ditambah', 'data' => $kelas], 201);
    }
    

    public function update(Request $request, $id)
    {
    $kelas = kelas::find($id);
    if (!$kelas) {
        return response()->json(['message' => 'Data kelas tidak ditemukan'], 404);
    }

    $validator = Validator::make($request->all(), [
        'kelas' => 'required|sometimes',
        'nama_kelas' => 'required|sometimes',
        'id_jurusan' => 'required|sometimes',
        'kode_kelas' => 'required|sometimes'
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Data kelas gagal diubah', 'data' => $validator->errors()], 400);
    }

    $kelas->nama_kelas = $request->input('nama_kelas', $kelas->nama_kelas);   
    $kelas->kelas = $request->input('kelas', $kelas->kelas);
    $kelas->id_jurusan = $request->input('id_jurusan', $kelas->id_jurusan);
    $kelas->kode_kelas = $request->input('kode_kelas', $kelas->kode_kelas);
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
