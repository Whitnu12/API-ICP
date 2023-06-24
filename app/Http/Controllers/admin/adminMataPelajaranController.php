<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\guru;

class adminMataPelajaranController extends Controller
{
    public function indexMapel()
{
    $mataPelajarans = MataPelajaran::with(['jurusan', 'guru:id_guru,nama,npp'])->get();
    
    // Memodifikasi respons JSON
    $data = [];
    foreach ($mataPelajarans as $mataPelajaran) {
        $mapelData = [
            'kode_mapel' => $mataPelajaran->kode_mapel,
            'nama_mapel' => $mataPelajaran->nama_mapel,
            'jurusan' => $mataPelajaran->jurusan,
            'guru' => $mataPelajaran->guru,
        ];
        $data[] = $mapelData;
    }
    
    return response()->json($data);
}

public function cariMapel($id)
{
    $mataPelajaran = MataPelajaran::with('guru:id_guru,nama,npp')->find($id);
    if (!$mataPelajaran) {
        return response()->json(['message' => 'Mata Pelajaran not found'], 404);
    }
    
    return response()->json($mataPelajaran);
}

    public function addMapel(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_mapel' => 'required',
                'id_jurusan' => 'required|exists:jurusan,id_jurusan',
                'id_guru' => 'required|array',
                'id_guru.*' => 'exists:gurus,id_guru',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
        
            $mataPelajaran = new MataPelajaran();
            $mataPelajaran->nama_mapel = $request->input('nama_mapel');
            $mataPelajaran->id_jurusan = $request->input('id_jurusan');
            $mataPelajaran->save();
        
            $gurus = $request->input('id_guru');
            foreach ($gurus as $guruId) {
                $mataPelajaran->guru()->attach($guruId);
            }
    
            return response()->json($mataPelajaran, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add Mata Pelajaran. Please try again. Error: ' . $e->getMessage()], 500);
        }
    }

    public function rubahMapel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required',
            'id_jurusan' => 'required',
            'id_guru' => 'required|array',
            'id_guru.*' => 'exists:gurus,id_guru',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $mataPelajaran = MataPelajaran::find($id);
            if (!$mataPelajaran) {
                return response()->json(['message' => 'Mata Pelajaran not found'], 404);
            }
    
            $mataPelajaran->nama_mapel = $request->input('nama_mapel');
            $mataPelajaran->id_jurusan = $request->input('id_jurusan');
            $mataPelajaran->save();
    
            $mataPelajaran->guru()->sync($request->input('id_guru'));
    
            return response()->json(['message' => 'Mata Pelajaran successfully updated', 'data' => $mataPelajaran]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update Mata Pelajaran. Please try again. Error: ' . $e->getMessage()], 500);
        }
    }

    public function hapusMapel($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        if (!$mataPelajaran) {
            return response()->json(['message' => 'Mata Pelajaran not found'], 404);
        }

        $mataPelajaran->delete();
        return response()->json(['message' => 'Mata Pelajaran deleted']);
    }
}
