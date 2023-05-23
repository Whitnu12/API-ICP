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
        $mataPelajarans = MataPelajaran::with(['jurusan', 'kelas', 'guru'])->get();;
        return response()->json($mataPelajarans);
    }

    public function cariMapel($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        if (!$mataPelajaran) {
            return response()->json(['message' => 'Mata Pelajaran not found'], 404);
        }
        return response()->json($mataPelajaran);
    }

    public function addMapel(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_mapel' => 'required',
                'id_jurusan' => 'required|exists:jurusan,id_jurusan',
                'id_kelas' => 'required|exists:kelas,id_kelas',
                'id_guru' => 'required|exists:gurus,id_guru',
            ]);
    
            // Mendapatkan objek Jurusan berdasarkan ID
            $jurusan = Jurusan::findOrFail($validatedData['id_jurusan']);
    
            // Mendapatkan objek Guru berdasarkan ID
            $guru = Guru::findOrFail($validatedData['id_guru']);
    
            // Mendapatkan objek Kelas berdasarkan ID
            $kelas = Kelas::findOrFail($validatedData['id_kelas']);
    
            // Menambahkan data MataPelajaran
            $mataPelajaran = new MataPelajaran();
            $mataPelajaran->nama_mapel = $validatedData['nama_mapel'];
    
            // Menyimpan relasi dengan Jurusan, Kelas, dan Guru pada MataPelajaran
            $mataPelajaran->jurusan()->associate($jurusan);
            $mataPelajaran->kelas()->associate($kelas);
            $mataPelajaran->guru()->associate($guru);
            $mataPelajaran->save();
    
            return response()->json($mataPelajaran, 201);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add Mata Pelajaran. Please try again.'], 500);
        }
    }

    public function rubahMapel(Request $request, $id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        if (!$mataPelajaran) {
            return response()->json(['message' => 'Mata Pelajaran not found'], 404);
        }

        $validatedData = $request->validate([
            'nama_mapel' => 'required',
            'id_jurusan' => 'required',
            'id_kelas' => 'required',
            'id_guru' => 'required',
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
