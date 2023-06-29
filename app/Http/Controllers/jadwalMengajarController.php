<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\jadwalMengajar;

class jadwalMengajarController extends Controller
{
    public function index()
    {
        $jadwalMengajar = JadwalMengajar::all();
        $jadwalMengajar->load('kelas:id_kelas,kode_kelas');
        $jadwalMengajar->load('guru:id_guru,nama');
        $jadwalMengajar->load('mapel:kode_mapel,nama_mapel');

        $jadwalMengajar->transform(function ($jadwal) {
            $jadwal->jam_mulai = substr($jadwal->jam_mulai, 0, 5); // Extract only the hours and minutes (e.g., "12:50")
            $jadwal->jam_selesai = substr($jadwal->jam_selesai, 0, 5); // Extract only the hours and minutes (e.g., "14:30")
            return $jadwal;
        });
    
        return response()->json($jadwalMengajar);
    }

    public function show($id_guru)
    {
        $jadwalMengajar = JadwalMengajar::where('id_guru', $id_guru)
            ->with('kelas:id_kelas,kode_kelas')
            ->with('guru:id_guru,nama')
            ->with('mapel:kode_mapel,nama_mapel')
            ->select('id_mengajar', 'kode_mapel', 'id_kelas', 'id_guru', 'jam_mulai', 'jam_selesai', 'hari', 'jam_belajar', 'created_at', 'updated_at')
            ->get();

        // Update the 'jamMulai' and 'jamSelesai' formats
        $jadwalMengajar->transform(function ($jadwal) {
            $jadwal->jam_mulai = substr($jadwal->jam_mulai, 0, 5); // Extract only the hours and minutes (e.g., "12:50")
            $jadwal->jam_selesai = substr($jadwal->jam_selesai, 0, 5); // Extract only the hours and minutes (e.g., "14:30")
            return $jadwal;
        });
        
        return response()->json($jadwalMengajar);
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id_guru' => 'required|exists:gurus,id_guru',
        'kode_mapel' => 'required|exists:mata_pelajarans,kode_mapel',
        'id_kelas' => 'required|exists:kelas,id_kelas',
        'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        'jam_mulai' => 'required',
        'jam_belajar' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $jamMulai = $request->input('jam_mulai');
    $jamBelajar = $request->input('jam_belajar');
    
    // Menghitung jam selesai
    $jamSelesai = date('H:i', strtotime($jamMulai . ' + ' . $jamBelajar * 45 . ' minutes'));
    
    $data = [
        'id_guru' => $request->input('id_guru'),
        'kode_mapel' => $request->input('kode_mapel'),
        'id_kelas' => $request->input('id_kelas'),
        'hari' => $request->input('hari'),
        'jam_mulai' => $jamMulai,
        'jam_belajar' => $jamBelajar,
        'jam_selesai' => $jamSelesai,
    ];

    try {
        $jadwalMengajar = JadwalMengajar::create($data);
        return response()->json(['message' => 'Berhasil menambah jadwal', 'data' => $jadwalMengajar]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to add jadwal. Please try again. Error: ' . $e->getMessage()], 500);
    }
}

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'id_guru' => 'required|exists:gurus,id_guru',
        'kode_mapel' => 'required|exists:mata_pelajarans,kode_mapel',
        'id_kelas' => 'required|exists:kelas,id_kelas',
        'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        'jam_mulai' => 'required',
        'jam_belajar' => 'required|integer',
        ]);

        $jadwalMengajar = JadwalMengajar::findOrFail($id);
        $jadwalMengajar->update($validatedData);
        return response()->json($jadwalMengajar, 200);
    }

    public function destroy($id)
    {
        $jadwalMengajar = JadwalMengajar::findOrFail($id);
        $jadwalMengajar->delete();
        return response()->json(null, 204);
    }
}
