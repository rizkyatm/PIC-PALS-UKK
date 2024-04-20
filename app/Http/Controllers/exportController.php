<?php

namespace App\Http\Controllers;

use App\Exports\AktivitasUserExport;
use App\Models\AktivitasUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class exportController extends Controller
{
    public function exportExcel()
    {
        // Mendapatkan data aktivitas dari model AktivitasUser dengan filter berdasarkan user_id
        $aktivitas = AktivitasUser::where('user_id', auth()->id())->get();

        // Mengatur properti lembar Excel
        return Excel::download(new AktivitasUserExport($aktivitas), 'aktivitas.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'filename' => 'aktivitas.xlsx'
        ]);
    }

    public function exportPDF()
    {
        $userId = Auth::id();
        $aktivitas = AktivitasUser::where('user_id', $userId)->get();
        $user = User::findOrFail($userId);
    
        // Membuat objek Dompdf
        $dompdf = new Dompdf();
    
        // Memuat tampilan ke objek Dompdf
        $html = view('export.pdf', compact('aktivitas', 'dompdf','user'));
        $dompdf->loadHtml($html);
    
        // Render PDF
        $dompdf->render();
    
        // Mengunduh file PDF
        return $dompdf->stream('aktivitas.pdf');
    }
    
}
