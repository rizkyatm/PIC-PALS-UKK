<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke model User (many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Foto (many-to-one)
    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }
}
