<?php

namespace App\Models;

use App\Http\Controllers\AlatController;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi'
    ];
    
    public function alats(){
        return $this->hasMany(alat::class);
    }
}
