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

        return response()->json(['message' => 'success', 'data' => $admin], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;

            return response()->json(['message' => 'success', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'success'], 200);
    }
}
