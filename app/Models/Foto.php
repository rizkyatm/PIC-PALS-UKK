<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class, 'likes', 'foto_id', 'user_id');
    }

    public function reportFotos()
    {
        return $this->hasMany(ReportFoto::class, 'report_foto', 'foto_id');
    }
}
