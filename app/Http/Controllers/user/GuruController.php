<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import model User
use App\Models\guru; // Import model guru
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreguruRequest;
use App\Http\Requests\UpdateguruRequest;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();

        return response()->json([
            'status' => 'success',
            'data' => $gurus
        ]);
    }

    // Fungsi untuk menampilkan data guru berdasarkan ID
    public function cariGuru($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $guru
        ]);
    }

    // Fungsi untuk menambahkan data guru baru
    public function tambahGuru(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'NPP' => 'required|unique:gurus',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jabatan' => 'required|in:guru,tenaga_pendidik',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
    
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    
        $guru = new Guru();
        $guru->nama = $request->nama;
        $guru->NPP = $request->NPP;
        $guru->email = $request->email;
        $guru->password = Hash::make($request->password);
        $guru->jabatan = $request->jabatan;
        $guru->user_id = $user->id;
        $guru->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil ditambahkan',
            'data' => $guru
        ], 201);

        // $validatedData = $request->validate([
        //     'nama' => 'required|string',
        //     'NPP' => 'required|string',
        //     'email' => 'required|email|unique:gurus,email',
        //     'password' => 'required|string|min:6',
        //     'jabatan' => 'required|in:guru,tenaga pendidik,admin',
        //     'foto_profil' => 'nullable|image'
        // ]);
        
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // if ($request->hasFile('foto_profil')) {
        //     $fotoProfil = $request->file('foto_profil')->store('public/foto_profil');
        //     $validatedData['foto_profil'] = $fotoProfil;
        // }

        

        // $guru = Guru::create($validatedData);

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data guru berhasil ditambahkan',
        //     'data' => $guru
        // ], 201);
    }

    // Fungsi untuk mengupdate data guru
    public function rubahGuru(Request $request, $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string',
            'npp' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:gurus,email,' . $guru->id,
            'password' => 'sometimes|required|string|min:6',
            'jabatan' => 'sometimes|required|in:guru,tenaga pendidik',
            'foto_profil' => 'sometimes|nullable|image'
        ]);

        if ($request->hasFile('foto_profil')) {
            $fotoProfil = $request->file('foto_profil')->store('public/foto_profil');
            $validatedData['foto_profil'] = $fotoProfil;
        }

        $guru->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    public function hapusGuru($id)
{
    $guru = Guru::find($id);

    if (!$guru) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data guru tidak ditemukan'
        ], 404);
    }

    $guru->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Data guru berhasil dihapus'
    ]);
}


}
