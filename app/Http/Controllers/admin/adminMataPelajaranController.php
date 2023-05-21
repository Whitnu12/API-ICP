<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class adminMataPelajaranController extends Controller
{
    public function indexMapel()
    {
        $mataPelajarans = MataPelajaran::all();
        return response()->json($mataPelajarans);
    }

    public function cariMapel($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        if (!$mataPelajaran) {
        return response()->json(['message' => 'Mata Pelajaran not found'], 404);
    }
    return response()->json($mataPelajaran);}

    public function addMapel(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mapel' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
        ]);
    
        // Menambahkan data MataPelajaran
        $mataPelajaran = MataPelajaran::create($validatedData);
    
        // Menambahkan data Jurusan
        $jurusan = Jurusan::firstOrCreate(['nama_jurusan' => $validatedData['jurusan']]);
    
        // Menambahkan data Kelas
        $kelas = Kelas::firstOrCreate(['nama_kelas' => $validatedData['kelas']]);
    
        // Menyimpan relasi dengan Jurusan dan Kelas pada MataPelajaran
        $mataPelajaran->jurusan()->associate($jurusan);
        $mataPelajaran->kelas()->associate($kelas);
        $mataPelajaran->save();
    
        return response()->json($mataPelajaran, 201);    }

    public function rubahMapel(Request $request ,$id)
    {

        $mataPelajaran = MataPelajaran::find($id);
        if (!$mataPelajaran) {
            return response()->json(['message' => 'Mata Pelajaran not found'], 404);
        }
    
        $validatedData = $request->validate([
            'nama_mapel' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
        ]);
    
        $mataPelajaran->update($validatedData);
        return response()->json($mataPelajaran);
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
