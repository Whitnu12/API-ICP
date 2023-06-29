<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\capaian_jam;
use App\Models\guru;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Validator;

class capaianJamController extends Controller
{
    public function index()
    {
        $capaian = capaian_jam::all();
    
        $data = [];
    
        foreach ($capaian as $item) {
            $mapel = MataPelajaran::where('kode_mapel', $item->kode_mapel)->first();
            $guru = guru::find($item->id_guru);
    
            $data[] = [
                'id_capaian' => $item->id_capaian,
                'id_guru' => $item->id_guru,
                'nama_guru' => $guru ? $guru->nama : '',
                'kode_mapel' => $item->kode_mapel,
                'nama_mapel' => $mapel ? $mapel->nama_mapel : '',
                'capaian_jam' => $item->capaian_jam,
                'jam_tercapai' => $item->jam_tercapai,
            ];
        }
    
        return response()->json(['message' => 'Data Capaian Jam Belajar berhasil diambil', 'data' => $data]);
    }

    public function show($id_guru)
    {
        $capaian = capaian_jam::where('id_guru', $id_guru)->get();

        if ($capaian->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data capaian tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian berhasil diambil',
            'data' => $capaian
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_guru' => 'required|exists:gurus,id_guru',
            'kode_mapel' => 'required|exists:mata_pelajarans,kode_mapel',
            'capaian_jam' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['jam_tercapai'] = 0; // Set nilai default jam_tercapai menjadi 0

        $capaian = capaian_jam::create($data);

        return response()->json(['message' => 'Data capaian jam berhasil ditambah', 'data' => $capaian], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jam_tercapai' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $capaian = capaian_jam::findOrFail($id);
        $jam_tercapai = $capaian->jam_tercapai + $request->input('jam_tercapai');
        $capaian_jam = $capaian->capaian_jam;

        if ($jam_tercapai > $capaian_jam) {
            return response()->json(['error' => 'Nilai jam_tercapai melebihi capaian_jam'], 400);
        }

        $capaian->jam_tercapai = $jam_tercapai;
        $capaian->save();

        return response()->json(['message' => 'Data capaian jam berhasil diupdate', 'data' => $capaian], 200);
    }

    public function updateAll(Request $request, $id){

        $capaian = capaian_jam::find($id);

        if(!$capaian){
            return response()->json([
                'status' => 'error',
                'message' => 'Data capaian tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(),[
            'id_guru' => 'sometimes|exists:gurus,id_guru',
            'kode_mapel' => 'sometimes|exists:mata_pelajarans,kode_mapel',
            'capaian_jam' => 'sometimes',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $capaian->id_guru = $request->input('id_guru');
        $capaian->kode_mapel = $request->input('kode_mapel');
        $capaian->capaian_jam = $request->input('capaian_jam');


        $capaian->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data capaian berhasil diperbarui',
            'data' => $capaian
        ], 200);

    }

    public function destroy($id)
    {
        $capaian = capaian_jam::findOrFail($id);
        $capaian->delete();
        return response()->json(['message' => 'Capaian berhasil dihapus'], 200);
    }
}
