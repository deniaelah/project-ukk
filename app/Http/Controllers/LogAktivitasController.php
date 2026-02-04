<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\log_aktivitas; // Note: Model name is lowercase based on user's file
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = log_aktivitas::with('user')
            ->latest()
            ->paginate(100);

        return view('log_aktivitas.log_aktivitas-list', compact('logs'));
    }
}
