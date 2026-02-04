<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\log_aktivitas; // Note: Model name is lowercase based on user's file
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // ... index, create ...

    public function index()
    {
        $query = Peminjaman::with('pengembalian','user', 'alat', 'approver')
            ->orderBy('created_at', 'asc');

        if (Auth::user()->role == 'peminjam') {
            $query->where('user_id', Auth::id());
        }

        $peminjamans = $query->paginate(100);

        return view('peminjaman.peminjaman-list', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('jumlah_tersedia', '>', 0)->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1'
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah_pinjam > $alat->jumlah_tersedia) {
            return back()->with('error', 'Jumlah pinjam melebihi stok');
        }

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_rencana_kembali' => $request->tanggal_rencana_kembali,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status_peminjaman' => 'menunggu'
        ]);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengajukan Peminjaman',
            'tabel_terkait' => 'peminjamans',
            'id_referensi' => $peminjaman->id
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Berhasil mengajukan peminjaman');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_peminjaman !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak bisa diedit');
        }

        $alats = Alat::all();

        return view('peminjaman.edit', compact('peminjaman', 'alats'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_peminjaman !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak bisa diubah');
        }

        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1'
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah_pinjam > $alat->jumlah_tersedia) {
            return back()->with('error', 'Jumlah pinjam melebihi stok');
        }

        $peminjaman->update([
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_rencana_kembali' => $request->tanggal_rencana_kembali,
            'jumlah_pinjam' => $request->jumlah_pinjam,
        ]);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengupdate Peminjaman',
            'tabel_terkait' => 'peminjamans',
            'id_referensi' => $peminjaman->id
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diupdate');
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $alat = $peminjaman->alat;

        if ($peminjaman->jumlah_pinjam > $alat->jumlah_tersedia) {
            return back()->with('error', 'Stok alat tidak mencukupi');
        }

        DB::transaction(function () use ($alat, $peminjaman) {
            $alat->decrement('jumlah_tersedia', $peminjaman->jumlah_pinjam);

            $peminjaman->update([
                'status_peminjaman' => 'dipinjam',
                'disetujui_oleh' => Auth::id()
            ]);

            log_aktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Menyetujui Peminjaman',
                'tabel_terkait' => 'peminjamans',
                'id_referensi' => $peminjaman->id
            ]);
        });

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status_peminjaman' => 'ditolak',
            'disetujui_oleh' => Auth::id()
        ]);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menolak Peminjaman',
            'tabel_terkait' => 'peminjamans',
            'id_referensi' => $peminjaman->id
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    public function delete($id){
        // $peminjamans = Peminjaman::findOrFail($id)->delete();
        $peminjaman = Peminjaman::findOrFail($id);
        $id_deleted = $peminjaman->id;
        $peminjaman->delete();

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus Peminjaman',
            'tabel_terkait' => 'peminjamans',
            'id_referensi' => $id_deleted
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'berhasil dihapus');
    }

    public function print()
    {
        $peminjamans = Peminjaman::with('pengembalian','user', 'alat', 'approver')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('peminjaman.cetak', compact('peminjamans'));
        return $pdf->download('laporan-peminjaman.pdf');
    }
}
