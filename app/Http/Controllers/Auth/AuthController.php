<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $response = [
        'message' => 'null',
        'data' => 'null',
    ];
    
    public function register(Request $req){

        $req -> validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        
        $data = User::create([
            'name' => $req -> name,
            'email' => $req -> email,
            'password' => bcrypt($req -> password),
        ]);

        $this->response['message'] = 'success';
        return response()->json($this->response,200);
    }

    public function login(Request $req){
        $req -> validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $req->email)->first();
        if(!$user){
            $this->response['message'] = 'Unauthorized';
            return response()->json($this->response,401);
        }

        $token = $user->createToken($req->device_name)->plainTextToken;
        $this->response['message'] = 'succes';
        $this->response['data'] = [
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($this->response,200);
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';
        return response()->json($this->response,200);
    }

    public function profile(Request $req){
        $this->response['message'] = 'success';
        $this->response['data'] = $req->user();
        return response()->json($this->response,200);
    }


}
