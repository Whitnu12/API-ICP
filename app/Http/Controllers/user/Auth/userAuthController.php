<?php

namespace App\Http\Controllers\user\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\guru;
use Illuminate\Support\Facades\Auth;

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
        'password' => 'required|string|min:6',
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

    $token = $user->createToken('')->plainTextToken;
    $this->response['message'] = 'success';
    $this->response['data'] = [
        'user' => $user,
        'token' => $token,
    ];

    return response()->json($this->response, 200);
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';
        return response()->json($this->response,200);
    }

    public function profile(Request $req){
    $user = $req->user();
    $guru = Guru::where('email', $user->email)->first();

    $this->response['message'] = 'success';
    $this->response['data'] = [
        'user' => $user,
        'guru' => $guru
    ];
    return response()->json($this->response, 200);
    }

 

    
}