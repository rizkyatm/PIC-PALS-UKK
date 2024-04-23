<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Jenislaporan;
use App\Models\ReportFoto;
use Illuminate\Http\Request;

class ReportFotoController extends Controller
{
    public function reportFoto(Request $request)
    {
        $jenisLaporanId = null;
    
        if ($request->filled('jenis_laporan_baru')) {
            // Buat data jenis laporan baru
            $jenisLaporanBaru = Jenislaporan::create([
                'jenis_laporan' => $request->jenis_laporan_baru,
                'is_enable' => '0',
            ]);
    
            // Ambil ID jenis laporan baru yang telah dibuat
            $jenisLaporanId = $jenisLaporanBaru->id;
        } else {
            // Ambil jenis_laporan_id dari input radio
            $jenisLaporanId = $request->jenis_laporan_id;
        }
    
        // Simpan data ReportFoto
        $reportFoto = ReportFoto::create([
            'foto_id' => $request->foto_id,
            'jenislaporan_id' => $jenisLaporanId,
            'user_id' => $request->pelapor_id,
            'status' => 'pending', // atau status apa pun yang sesuai
        ]);
    
        // Buat respons untuk dikirim kembali ke JavaScript
        $response = [
            'success' => true,
            'message' => 'ReportFoto berhasil ditambahkan.',
            'report_foto_id' => $reportFoto->id, // ID report foto yang baru saja dibuat
        ];
    
        // Kembalikan respons dalam bentuk JSON
        return response()->json($response);
    }

    public function indexx(){
        $reports = ReportFoto::with('fotos', 'pelapors', 'jenisLaporans')
        ->Where('status', 'Laporan Tidak valid')
        ->orWhere('status', 'Laporan valid')
        ->get();
        return view('admin.history', compact('reports'));
    }

    public function index()
    {
        $reports = ReportFoto::all();
    
        // Kelompokkan berdasarkan foto_id
        $groupedReports = $reports->groupBy('foto_id');
    
        return view('admin.reportUser', compact('groupedReports', 'reports'));
    }

    public function deleteFoto($id)
    {
        // Temukan foto berdasarkan ID
        $foto = Foto::findOrFail($id);
        
        // Hapus foto
        $foto->delete();

        // Hapus entri di report_foto dengan foto_id tertentu
        ReportFoto::where('foto_id', $id)->delete();

        // Redirect atau berikan respon sesuai kebutuhan
        return redirect()->back()->with('success', 'Foto dan entri di report_foto berhasil dihapus.');
    }
    

    
}
