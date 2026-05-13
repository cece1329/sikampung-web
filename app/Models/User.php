<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'pin',
        'role',
        'rt',
        'rw',
    ];

    /**
     * Kolom yang disembunyikan saat data diubah jadi Array/JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke tabel Laporan.
     * Seorang user bisa punya banyak laporan.
     */
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}