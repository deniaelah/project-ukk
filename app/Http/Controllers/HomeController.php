<?php

namespace App\Http\Controllers;

use App\Models\Alat;

class HomeController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')
            ->orderBy('nama_alat', 'asc')
            ->get();

        return view('index', compact('alats'));
    }
}
