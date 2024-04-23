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

    public function index(){
        $reports = ReportFoto::with('fotos', 'pelapors', 'jenisLaporans')
        ->where('status', 'pending')
        ->get();
        return view('admin.reportUser', compact('reports'));
    }
    public function indexx(){
        $reports = ReportFoto::with('fotos', 'pelapors', 'jenisLaporans')
        ->Where('status', 'Laporan Tidak valid')
        ->orWhere('status', 'Laporan valid')
        ->get();
        return view('admin.history', compact('reports'));
    }


    public function updateStatusValid($id)
    {
        // Cari laporan berdasarkan ID
        $report = ReportFoto::findOrFail($id);
    
        // Ubah status menjadi 'Laporan valid'
        $report->update(['status' => 'Laporan valid']);
    
        // Periksa apakah ada lebih dari 10 entri dengan foto_id yang sama dan status 'Laporan valid'
        $fotoCount = ReportFoto::where('foto_id', $report->foto_id)
                                ->where('status', 'Laporan valid')
                                ->count();
    
        // Jika jumlah entri lebih dari 10, hapus salah satu foto dengan foto_id yang sama
        if ($fotoCount > 10) {
            $fotoToDelete = Foto::find($report->foto_id);
            if ($fotoToDelete) {
                $fotoToDelete->delete();
            }
            
            // Hapus semua entri di tabel report_foto dengan foto_id yang sama
            ReportFoto::where('foto_id', $report->foto_id)->delete();
        }
    
        // Redirect kembali ke halaman sebelumnya atau ke halaman tertentu
        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    
    

    public function updateStatusTidakValid($id)
    {
        // Cari laporan berdasarkan ID
        $report = ReportFoto::findOrFail($id);
        
        // Ubah status menjadi 'Laporan valid'
        $report->update(['status' => 'Laporan Tidak valid']);

        // Redirect kembali ke halaman sebelumnya atau ke halaman tertentu
        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    
}
