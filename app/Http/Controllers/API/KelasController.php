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
        return response()->json($kelas);
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
        ]);

        $kelas = Kelas::create($validatedData);
        return response()->json($kelas, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id,
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validatedData);
        return response()->json($kelas, 200);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json(null, 204);
    }

}
