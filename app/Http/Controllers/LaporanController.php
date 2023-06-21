<?php

namespace App\Http\Controllers;

use App\Models\gambar_laporan;
use App\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class LaporanController extends Controller
{
    
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
            $gambarPath = $gambar->store('foto_kegiatan');

            // Simpan informasi gambar ke database
            $gambarLaporan = new gambar_laporan();
            $gambarLaporan->name = $gambar->getClientOriginalName();
            $gambarLaporan->path = $gambarPath;
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
    // try {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'judul_laporan' => 'required',
    //         'tanggal' => 'required',
    //         'deskripsi_laporan' => 'required',
    //         'id_jenis' => 'required|exists:jenis_laporan,id_jenis',
    //         'gambar'     => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     // Buat laporan baru
    //     $laporan = Laporan::create([
    //         'judul_laporan' => $request->judul_laporan,
    //         'deskripsi_laporan' => $request->deskripsi_laporan,
    //         'tanggal' => $request->tanggal,
    //         'id_jenis' => $request->id_jenis,
    //     ]);

    //     Upload gambar-gambar ke storage dan simpan informasi gambar ke database
    //     $gambarPaths = [];
    //     foreach ($request->file('gambar') as $gambar) {
    //         $gambarPath = $gambar->store('foto_kegiatan');

    //         // Simpan informasi gambar ke database
    //         $gambarLaporan = new gambar_laporan();
    //         $gambarLaporan->nama = $gambar->getClientOriginalName();
    //         $gambarLaporan->path = $gambarPath;
    //         $gambarLaporan->laporan_id = $laporan->id; // Gunakan ID laporan yang baru dibuat
    //         $gambarLaporan->save();

    //         $gambarPaths[] = $gambarPath;
    //     }
        
    //     // foreach ($request->file('gambar') as $imagefile) {
    //     //     $image = new gambar_laporan();
    //     //     $path = $imagefile->store('/images/resource');
    //     //     $image->path = $path;
    //     //     $image ->name = $image->getClientOriginalName();
    //     //     $image->laporan_id = $laporan->id;
    //     //     $image->save();
    //     //   }
    //     // $image =[$image,path];
    //     $laporan->save();

    //     // $image = $request->file('gambar');
    //     // $image->storeAs('public/foto_kegiatan', $image->hashName());

    //     // //create post
    //     // $post = gambar_laporan::create([
    //     //     'path'     => $image->hashName(),
    //     //     'name'     => $image->getClientOriginalName(),
    //     //     'id_laporan'   => $laporan->id_laporan,
    //     // ]);

    //     // Update kolom 'gambar' pada laporan dengan array path gambar

    //     return response()->json([
    //         'message' => 'Laporan created successfully',
    //         'data' => $laporan, $image,
    //     ], 201);
    // } catch (\Exception $e) {
    //     return response()->json([
    //         'message' => 'Error creating laporan',
    //         'error' => $e->getMessage(),
    //     ], 500);
    // }
}


public function show($id)
{
    $laporan = laporan::findOrFail($id);
    $gambar = gambar_laporan::where('id_laporan', $laporan->id_laporan)->get();

    return response()->json([
        'message' => 'Success',
        'data' => $laporan,
        'gambar' => $gambar,
    ]);
}

}
     
    
    

