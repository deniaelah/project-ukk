<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index (){
        $total_user = User::count();
        $total_alat = Alat::count();
        $total_stok = Alat::sum('jumlah_tersedia');
        
        $sedang_dipinjam = Peminjaman::whereIn('status_peminjaman', ['menunggu', 'dipinjam'])->count();
        $selesai_dikembalikan = Pengembalian::count();

        $recent_peminjaman = Peminjaman::with('user', 'alat')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_user',
            'total_alat',
            'total_stok',
            'sedang_dipinjam',
            'selesai_dikembalikan',
            'recent_peminjaman'
        ));
    }
}
