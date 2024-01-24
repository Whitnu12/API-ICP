<?php

namespace App\Http\Controllers\user\Auth;

use App\Http\Controllers\Controller;
use App\Models\guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userAuthController extends Controller
{
    private $response = [
        'message' => 'null',
        'data' => 'null',
    ];

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $req->email)->first();
        if (!$user) {
            $this->response['message'] = 'Email Salah!';

            return response()->json($this->response, 401);
        }

        if (!Hash::check($req->password, $user->password)) {
            $this->response['message'] = 'Password Salah!';

            return response()->json($this->response, 401);
        }

        $additionalInfo = null;

        if ($user->siswa) {
            $additionalInfo = [
                'nis' => $user->siswa->nis,
            ];
        } elseif ($user->guru) {
            $additionalInfo = [
                'nip' => $user->guru->nip,
            ];
        }

        $token = $user->createToken('')->plainTextToken;

        $this->response['message'] = 'success';
        $this->response['data'] = [
            'user' => [
                'name' => $user->name,
                'id' => $user->id,
                'nis_nip' => $additionalInfo ? reset($additionalInfo) : null,
            ],
            'token' => $token,
        ];

        return response()->json($this->response, 200);
    }

    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';

        return response()->json($this->response, 200);
    }

    public function profile(Request $req)
    {
        $user = $req->user();
        $guru = Guru::where('email', $user->email)->first();

        $this->response['message'] = 'success';
        $this->response['data'] = [
            'user' => $user,
            'guru' => $guru,
        ];

        return response()->json($this->response, 200);
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nis_nip' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Menentukan tipe pengguna berdasarkan panjang nis_nip
        $userType = strlen($request->nis_nip) <= 5 ? 'siswa' : 'guru';

        // Pengecekan apakah nis_nip telah diisi
        if (!$request->has('nis_nip') || empty($request->nis_nip)) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIS/NIP harus diisi.',
            ], 400);
        }

        // Membuat user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Menyimpan data tambahan sesuai dengan tipe user
        if ($userType === 'siswa') {
            $siswa = new Siswa();
            $siswa->nis = $request->nis_nip;
            $siswa->user_id = $user->id;
            $siswa->save();
        } else {
            $guru = new Guru();
            $guru->nip = $request->nis_nip;
            $guru->user_id = $user->id;
            $guru->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil',
            'user_type' => $userType,
        ], 201);
    }
}
