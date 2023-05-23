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
            'npp' => 'required|unique:gurus',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jabatan' => 'required|in:guru,tenaga_kependidikan',
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
        $guru->npp = $request->npp;
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
    
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string',
            'npp' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $guru->user->id,            
            'password_lama' => 'required',
            'password_baru' => 'sometimes|required|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
    
        // Validasi password lama
        if (!Hash::check($request->password_lama, $guru->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama tidak cocok'
            ], 400);
        }
    
        // Update data guru
        $guru->nama = $request->nama ?? $guru->nama;
        $guru->npp = $request->npp ?? $guru->npp;
        $guru->email = $request->email ?? $guru->email;
    
        if ($request->has('password_baru')) {
            $guru->password = Hash::make($request->password_baru);
        }
    
        $guru->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    public function hapusGuru($id)
    {
    try {
        $guru = Guru::findOrFail($id);
        $user = User::where('email', $guru->email)->first();

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $guru->delete();

        if ($user) {
            $user->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil dihapus'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat menghapus data guru'
        ], 500);
    }
}

public function validatePassword(Request $request)
{
    $request->validate([
        'id' => 'required',
        'password' => 'required',
    ]);

    $guru = Guru::find($request->id);

    if (!$guru) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data guru tidak ditemukan'
        ], 404);
    }

    if (Hash::check($request->password, $guru->password)) {
        return response()->json([
            'status' => 'success',
            'message' => 'Password valid'
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Password tidak valid'
        ], 401);
    }
}


}
