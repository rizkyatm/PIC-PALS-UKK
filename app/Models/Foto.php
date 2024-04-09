<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $guarded = [];

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
        return $this->belongsToMany(User::class, 'likes', 'foto_id', 'user_id');
    }

}
