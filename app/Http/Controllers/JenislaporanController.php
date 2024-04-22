<?php

namespace App\Http\Controllers;

use App\Models\Jenislaporan;
use Illuminate\Http\Request;

class JenislaporanController extends Controller
{
    public function index()
    {
        return view('admin.tableJenisLaporan');
    }

    public function create(Request $request)
    {
        // Simpan jenis laporan tanpa validasi
        $jenisLaporan = new JenisLaporan();
        $jenisLaporan->jenis_laporan = $request->jenis_laporan;
        $jenisLaporan->is_enable = 1;
        $jenisLaporan->save();
    
        // Beri respons sukses
        return response()->json(['message' => 'Jenis laporan berhasil disimpan'], 200);
    }

    public function loadJenisLaporan()
    {
        // Mengambil semua data jenis laporan
        $jenisLaporan = JenisLaporan::latest()->get();

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'data' => $jenisLaporan
        ]);
    }
    

    public function store(Request $request)
    {
        //
    }

    public function show(Jenislaporan $jenislaporan)
    {
        //
    }

    public function edit(Jenislaporan $jenislaporan)
    {
        //
    }

    public function update(Request $request, Jenislaporan $jenislaporan)
    {
        //
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        JenisLaporan::destroy($id);

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
