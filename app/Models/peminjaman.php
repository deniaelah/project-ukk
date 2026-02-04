<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjamen';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_rencana_kembali',
        'jumlah_pinjam',
        'status_peminjaman',
        'disetujui_oleh'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat()
    {
        return $this->belongsTo(alat::class, 'alat_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjamen_id');
    }
}
