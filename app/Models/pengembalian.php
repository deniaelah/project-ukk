<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    protected $fillable = [
        'peminjamen_id',
        'tanggal_kembali',
        'jumlah_kembali',
        'kondisi_kembali',
        'denda',
        'status_pengembalian',
        'diproses_oleh'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjamen_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }
}
