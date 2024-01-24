<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mataPelajarans = MataPelajaran::all();

        return response()->json([
            'status' => 'success',
            'data' => $mataPelajarans,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addMapel(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string',
            'enroll_code' => 'required|unique:mata_pelajarans',
            'idUser' => 'required|exists:users,id', // Ubah validasi dari 'id_guru' ke 'idUser'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $mataPelajaran = new MataPelajaran();

        // Mengambil data guru berdasarkan idUser dari request
        $guru = Guru::where('user_id', $request->idUser)->firstOrFail();

        // Mengisi atribut pada objek $mataPelajaran
        $mataPelajaran->guru()->associate($guru);
        $mataPelajaran->nama_mapel = $request->nama_mapel;
        $mataPelajaran->enroll_code = $request->enroll_code;

        // Mengisi created_by dengan nama guru yang sedang login
        $mataPelajaran->created_by = $guru->user->name;

        $mataPelajaran->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Mata pelajaran berhasil ditambahkan',
            'data' => $mataPelajaran,
        ], 201);
    }

    public function showDetail($id)
    {
        // Ambil data mata pelajaran berdasarkan ID dari database
        $mataPelajaran = MataPelajaran::find($id);

        // Kemudian, kirim data ke halaman detail
        return view('admin.detail-mapel', compact('mataPelajaran'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
    }
}
