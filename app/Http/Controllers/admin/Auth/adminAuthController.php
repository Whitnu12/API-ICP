<?php

namespace App\Http\Controllers\admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class adminAuthController extends Controller
{
    private $response = [
        'message' => 'null',
        'data' => 'null',
    ];

    public function dashboard(Request $request)
    {
        // Lakukan pengecekan apakah pengguna telah login sebagai admin
        if (Auth::guard('admin')->check()) {
            // Jika pengguna sudah login, tampilkan halaman dashboard
            $admin = Auth::guard('admin')->user(); // Mendapatkan data admin yang sedang login
            $viewData = [
                'admin' => $admin,
                'token' => $request->bearerToken() // Menyimpan token dari request ke dalam variabel $token
            ];
            
            return view('admin/dashboard')->with($viewData);
        } else {
            // Jika pengguna belum login, redirect ke halaman login
            return redirect()->route('login');
        }
    }

    public function checkAdmin()
    {
        // Mengambil data admin yang sedang login
        $admin = Auth::guard('admin')->user();

        return response()->json([
            'message' => 'success',
            'data' => [
                'admin' => $admin,
            ],
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'npp' => 'required|unique:admins',
            'nama' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'npp' => $request->npp,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->response['message'] = 'success';
        $this->response['data'] = $admin;

        return response()->json($this->response, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;

            // Simpan data pengguna dalam session (opsional, sesuaikan dengan kebutuhan Anda)
            session(['admin' => $admin]);

            // Mengembalikan respons JSON dengan pesan "success" dan token
            return response()->json([
                'message' => 'success',
                'token' => $token,
            ], 200);
        } else {
            // Autentikasi gagal, kembalikan respon error
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $this->response['message'] = 'success';
        return redirect()->route('login');
        return response()->json($this->response, 200);
    }
}
