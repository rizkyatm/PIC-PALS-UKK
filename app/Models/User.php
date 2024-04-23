<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    public function aktivitas_user()
    {
        return $this->hasMany(AktivitasUser::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Foto::class, 'likes', 'user_id', 'foto_id');
    }

    public function reportFotos()
    {
        return $this->belongsToMany(ReportFoto::class, 'report_foto', 'pelapor_id', 'report_foto_id');
    }

}

