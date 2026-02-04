<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\log_aktivitas;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::with('alats')->orderBy('created_at', 'asc')->paginate(5);
        return view('kategori.kategori-list', compact('kategoris'));
    }
    public function create()
    {
        $alats = alat::all();
        return view('kategori.create', compact('alats'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);
        $kategori = Kategori::create($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menambah Kategori',
            'tabel_terkait' => 'kategoris',
            'id_referensi' => $kategori->id
        ]);

        return redirect()->route('kategori.index')->with('Sukses', 'Berhasil tambah');
    }
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);
        $kategori->update($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengedit Kategori',
            'tabel_terkait' => 'kategoris',
            'id_referensi' => $kategori->id
        ]);

        return redirect()->route('kategori.index')->with('Sukses', 'Berhasil edit');
    }
    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus Kategori',
            'tabel_terkait' => 'kategoris',
            'id_referensi' => $id
        ]);

        return redirect()->route('kategori.index')->with('Sukses', 'Berhasil hapus');
    }
}
