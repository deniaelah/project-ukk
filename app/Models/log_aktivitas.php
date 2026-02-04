<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_aktivitas extends Model
{
    protected $fillable = [
        'user_id',
        'aktivitas',
        'tabel_terkait',
        'id_referensi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
