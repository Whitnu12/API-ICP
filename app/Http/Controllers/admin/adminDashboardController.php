<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getAdmin()
    {
        // Mengambil data admin dari database
        $admin = Admin::where('email', auth('admin')->user()->email)->first();

        // Mengembalikan data admin dalam bentuk JSON
        return response()->json(['data' => ['admin' => $admin]]);
    }
}
