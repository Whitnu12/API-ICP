<?php

namespace App\Http\Controllers;

use App\Models\tugas;
use Illuminate\Http\Request;

class tugasController extends Controller
{
    public function informasiNilaiTugas()
    {
        return view('admin.nilai-tugas');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(tugas $tugas)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tugas $tugas)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tugas $tugas)
    {
    }

    public function createTugas(Request $request, $idMapel)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_tugas' => 'required|string|unique:tugas',
            'deskripsi_tugas' => 'required|string',
            'deadline_tugas' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Lakukan operasi membuat tugas
        $tugas = new Tugas();
        $tugas->nama_tugas = $request->input('nama_tugas');
        $tugas->deskripsi_tugas = $request->input('deskripsi_tugas');
        $tugas->deadline_tugas = $request->input('deadline_tugas');
        $tugas->id_mapel = $idMapel; // Sesuaikan dengan parameter yang diterima
        $tugas->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil dibuat',
            'data' => $tugas,
        ], 201);
    }
}
