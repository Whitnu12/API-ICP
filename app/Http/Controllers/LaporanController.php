<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Laporan::all();

        return response()->json([
            'message' => 'Success',
            'data' => $laporan,
        ]);
    }

    public function store(Request $request)
    {
         // Validasi input dari request
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'jenis_laporan_id' => 'required|exists:jenis_laporan,id',
        'gambar' => 'required|array|min:1|max:5',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload gambar-gambar
    $gambarNames = [];
    foreach ($request->file('gambar') as $gambar) {
        $gambarName = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path('images'), $gambarName);
        $gambarNames[] = $gambarName;
    }

    // Buat laporan baru
    $laporan = Laporan::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'jenis_laporan_id' => $request->jenis_laporan_id,
        'gambar' => $gambarNames,
    ]);

    return response()->json([
        'message' => 'Laporan created successfully',
        'data' => $laporan,
    ], 201);
    }

    
}
