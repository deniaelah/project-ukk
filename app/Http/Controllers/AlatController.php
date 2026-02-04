<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\log_aktivitas;
use Illuminate\Support\Facades\Auth;

class AlatController extends Controller
{
    public function index(Request $request){
        $alats = alat::with('kategori')
        ->orderBy('created_at', 'asc')
        ->paginate(5);
        return view('alat.alat-list', compact('alats'));
    }
    public function create(){
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'kategori_id' => 'required',
            'kode_alat' => 'nullable|string',
            'nama_alat' => 'required|string',
            'spesifikasi' => 'nullable|string',
            'jumlah_total' => 'required|integer',
            'jumlah_tersedia' => 'required|integer',
            'kondisi' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        $alat = alat::create($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menambah Alat',
            'tabel_terkait' => 'alats',
            'id_referensi' => $alat->id
        ]);

        return redirect()->route('alat.index')->with('Sukses', 'Berhasil tambah');
    }
    public function edit($id){
    $alat = alat::findOrFail($id);
    $kategoris = Kategori::all();
    return view('alat.edit', compact('alat', 'kategoris'));
    }
    public function update(Request $request, $id){
        $alat = alat::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'required',
            'kode_alat' => 'nullable|string',
            'nama_alat' => 'required|string',
            'spesifikasi' => 'nullable|string',
            'jumlah_total' => 'required|integer',
            'jumlah_tersedia' => 'required|integer',
            'kondisi' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        $alat->update($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengedit Alat',
            'tabel_terkait' => 'alats',
            'id_referensi' => $alat->id
        ]);

        return redirect()->route('alat.index')->with('Sukses', 'Berhasil edit');
    }
    public function delete($id){
        $alat = alat::findOrFail($id);
        $alat->delete();

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus Alat',
            'tabel_terkait' => 'alats',
            'id_referensi' => $id
        ]);

        return redirect()->route('alat.index')->with('Sukses', 'Berhasil hapus');
    }

}
