<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasUser extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_user';

    protected $fillable = [
        'user_id',
        'aktivitas',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
