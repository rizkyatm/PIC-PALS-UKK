<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenislaporan extends Model
{
    use HasFactory;

    protected $table = 'jenislaporans';
    protected $guarded = [];

    
    public function reportFotos()
    {
        return $this->belongsToMany(ReportFoto::class, 'report_foto', 'jenis_laporan_id', 'report_foto_id');
    }

}
