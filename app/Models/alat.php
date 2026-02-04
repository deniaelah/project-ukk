<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alat extends Model
{
    protected $fillable = [
        'kategori_id',
        'kode_alat',
        'nama_alat',
        'spesifikasi',
        'jumlah_total',
        'jumlah_tersedia',
        'kondisi',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function peminjamans()
    {
        return $this->hasMany(peminjaman::class, 'alat_id');
    }
}
