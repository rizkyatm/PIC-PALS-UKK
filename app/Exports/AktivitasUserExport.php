<?php

namespace App\Exports;

use App\Models\AktivitasUser;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AktivitasUserExport implements FromView
{
    public function view(): View
    {
        // Mengirim data aktivitas ke view export.blade.php
        return view('export.export-aktivitas-user', [
            'aktivitas' => AktivitasUser::where('user_id', auth()->id())->get(),
        ]);
    }
}

