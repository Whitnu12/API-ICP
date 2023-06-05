<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalMengajar;

class jadwalMengajarController extends Controller
{
    public function index()
    {
        $jadwalMengajar = JadwalMengajar::all();
        return response()->json($jadwalMengajar);
    }

    public function show($id)
    {
        $jadwalMengajar = JadwalMengajar::findOrFail($id);
        return response()->json($jadwalMengajar);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_guru' => 'required',
            'kode_mapel' => 'required',
            'id_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwalMengajar = JadwalMengajar::create($validatedData);
        return response()->json(['message' => 'berhasil menambah jadwal', 'data' =>$jadwalMengajar]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwalMengajar = JadwalMengajar::findOrFail($id);
        $jadwalMengajar->update($validatedData);
        return response()->json($jadwalMengajar, 200);
    }

    public function destroy($id)
    {
        $jadwalMengajar = JadwalMengajar::findOrFail($id);
        $jadwalMengajar->delete();
        return response()->json(null, 204);
    }
}
