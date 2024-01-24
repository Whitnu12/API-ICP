<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User; // Import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();

        return response()->json([
            'status' => 'success',
            'data' => $siswa,
        ]);
    }

    public function cariSiswa($id)
    {
        $siswa = siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $siswa,
        ]);
    }

    public function registerSiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nis' => 'required|unique:siswa|min:8',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
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

        $siswa = new Siswa();
        $siswa->nis = $request->nis;
        $siswa->user_id = $user->id;
        $siswa->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa,
        ], 201);
    }
}
