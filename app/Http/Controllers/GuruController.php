<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guru;
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
    public function show($id)
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'NPP' => 'required|string',
            'email' => 'required|email|unique:gurus,email',
            'password' => 'required|string|min:6',
            'jabatan' => 'required|in:guru,tenaga pendidik,admin',
            'foto_profil' => 'nullable|image'
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);

        if ($request->hasFile('foto_profil')) {
            $fotoProfil = $request->file('foto_profil')->store('public/foto_profil');
            $validatedData['foto_profil'] = $fotoProfil;
        }

        

        $guru = Guru::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil ditambahkan',
            'data' => $guru
        ], 201);
    }

    // Fungsi untuk mengupdate data guru
    public function update(Request $request, $id)
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
            'jabatan' => 'sometimes|required|in:guru,tenaga pendidik,admin',
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

    public function destroy($id)
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

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Email dan password wajib diisi'
        ], 400);
    }

    $guru = Guru::where('email', $request->email)->first();

    if (!$guru || !Hash::check($request->password, $guru->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

    $token = $guru->createToken('guru')->plainTextToken;

    return response()->json([
        'success' => true,
        'guru' => $guru,
        'token' => $token
    ], 200);
}

}
