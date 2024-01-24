<?php

namespace App\Http\Controllers;

use App\Models\kuis;
use Illuminate\Http\Request;

class kuisController extends Controller
{
    public function informasiNilaiKuis()
    {
        return view('admin.nilai-kuis');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(kuis $kuis)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kuis $kuis)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rest $rest)
    {
    }
}
