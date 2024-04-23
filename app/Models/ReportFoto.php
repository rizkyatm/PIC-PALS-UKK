<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFoto extends Model
{
    use HasFactory;

    protected $table = 'report_foto';
    protected $guarded = [];


    public function jenisLaporans()
    {
        return $this->belongsTo(JenisLaporan::class, 'jenislaporan_id');
    }

    public function fotos()
    {
        return $this->belongsTo(Foto::class, 'foto_id');
    }

    public function pelapors()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
