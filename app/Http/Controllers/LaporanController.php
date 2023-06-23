<?php

namespace App\Http\Controllers;

use App\Models\gambar_laporan;
use App\Models\guru;
use App\Models\jenisLaporan;
use App\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;




class LaporanController extends Controller
{
    
    public function index()
{
    $laporan = Laporan::all();

    $laporan->transform(function ($item) {
        $guru = guru::find($item->id_guru);
        $jenisLaporan = jenisLaporan::find($item->id_jenis);

        $item->id_guru = $guru->nama;
        $item->id_jenis = $jenisLaporan->jenis_laporan;

        return $item;
    });

    return response()->json([
        'message' => 'success',
        'data' => $laporan,
    ]);
}

    public function store(Request $request)
{

    try {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'judul_laporan' => 'required',
            'id_guru' =>'required|exists:gurus,id_guru',
            'tanggal' => 'required',
            'deskripsi_laporan' => 'required',
            'id_jenis' => 'required|exists:jenis_laporan,id_jenis',
            'gambar' => 'required|array|min:1|max:5',
            'gambar.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat laporan baru
        $laporan = Laporan::create([
            'judul_laporan' => $request->judul_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'tanggal' => $request->tanggal,
            'id_jenis' => $request->id_jenis,
            'id_guru' => $request->id_guru,
        ]);

        $gambarPaths = [];
        // Upload gambar-gambar ke storage dan simpan informasi gambar ke database
        foreach ($request->file('gambar') as $gambar) {
            $gambarPath = $gambar->store('public/foto_kegiatan');

            // Simpan informasi gambar ke database
            $gambarLaporan = new gambar_laporan();
            $gambarLaporan->name = $gambar->getClientOriginalName();
            $gambarLaporan->path = str_replace('public/', '', $gambarPath);
            $gambarLaporan->id_laporan = $laporan->id_laporan; // Gunakan ID laporan yang baru dibuat
            $gambarLaporan->save();

            $gambarPaths = $gambarPath;
        }

       $laporan->gambar = $gambarPaths;

        return response()->json([
            'message' => 'Laporan created successfully',
            'data' => $laporan,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error creating laporan',
            'error' => $e->getMessage(),
        ], 500);
    }
}


public function show($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
    
            // Mengambil URL gambar dari database
            $gambarURLs = gambar_laporan::where('id_laporan', $laporan->id_laporan)
                ->pluck('path')
                ->map(function ($path) {
                    return $this->getGambarURL($path);
                });
    
            $laporan->gambar = $gambarURLs;
    
            return response()->json(['data' => $laporan], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving laporan', 'error' => $e->getMessage()], 500);
        }
    }
    
    protected function getGambarURL($path)
    {
        $serverURL = 'http://192.168.100.6/laravel-icp2/public/storage'; // Ganti dengan URL server Anda
        $gambarURL = $serverURL . '/' . $path;
    
        return $gambarURL;
    }

    public function delete($id)
    {
        try {
            $laporan = laporan::findOrFail($id);
            $gambarLaporans = gambar_laporan::where('id_laporan', $laporan->id_laporan)->get();    
            foreach ($gambarLaporans as $gambarLaporan) {
                Storage::delete($gambarLaporan->path);    
                $gambarLaporan->delete();
            }
            $laporan->delete();
    
            return response()->json([
                'message' => 'Laporan deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting laporan', 'error' => $e->getMessage()], 500);
        }
    }
}
     
    
    

