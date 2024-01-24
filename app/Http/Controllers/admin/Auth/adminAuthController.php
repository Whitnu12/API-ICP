<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class adminAuthController extends Controller
{
    private $response = [
        'message' => 'null',
        'data' => 'null',
    ];

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip_admin' => 'required|unique:admins',
            'name' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $admin = new Admin();
        $admin->nip_admin = $request->nip_admin;
        $admin->user_id = $request->$user->id;
        $admin->save();

        return response()->json(['status' => 'success', 'message' => 'User registered successfully', 'data' => $admin], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            $admin = Auth::guard('user')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;

            return response()->json(['message' => 'success', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return response()->json(['message' => 'success'], 200);
    }
}
