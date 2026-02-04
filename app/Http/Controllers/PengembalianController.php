<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\log_aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // ... index, create ...

    public function index()
    {
        $query = Pengembalian::with(
            'peminjaman.user',
            'peminjaman.alat',
            'petugas'
        )->orderBy('created_at','desc');

        if (Auth::user()->role == 'peminjam') {
            $query->whereHas('peminjaman', function($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $pengembalians = $query->paginate(5);

        return view('pengembalian.pengembalian-list', compact('pengembalians'));
    }

    public function create($peminjamen_id)
    {
        $peminjaman = Peminjaman::with('alat','user')
            ->where('status_peminjaman', 'dipinjam')
            ->findOrFail($peminjamen_id);

        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjamen_id' => 'required|exists:peminjamen,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi_kembali' => 'required|in:baik,rusak,hilang'
        ]);

        $peminjaman = Peminjaman::with('alat')->findOrFail($request->peminjamen_id);

        // 🔹 hitung keterlambatan
        $terlambat = Carbon::parse($request->tanggal_kembali)
            ->gt(Carbon::parse($peminjaman->tanggal_rencana_kembali));

        $status = $terlambat ? 'terlambat' : 'tepat waktu';

        // 🔹 hitung denda (contoh: 5.000 / hari)
        $denda = 0;
        if ($terlambat) {
            $hari = Carbon::parse($peminjaman->tanggal_rencana_kembali)
                ->diffInDays(Carbon::parse($request->tanggal_kembali));
            $denda = $hari * 5000;
        }

        // 🔹 Transaksi Database (agar aman jika error)
        DB::transaction(function () use ($request, $peminjaman, $status, $denda) {
             // 🔹 simpan pengembalian
            $pengembalian = Pengembalian::create([
                'peminjamen_id' => $peminjaman->id,
                'tanggal_kembali' => $request->tanggal_kembali,
                'jumlah_kembali' => $request->jumlah_kembali,
                'kondisi_kembali' => $request->kondisi_kembali,
                'denda' => $denda,
                'status_pengembalian' => $status,
                'diproses_oleh' => Auth::id()
            ]);

            // 🔹 update stok alat
            $peminjaman->alat->increment('jumlah_tersedia', $request->jumlah_kembali);

            // 🔹 update status peminjaman
            $peminjaman->update([
                'status_peminjaman' => 'selesai'
            ]);

            log_aktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Memproses Pengembalian',
                'tabel_terkait' => 'pengembalians',
                'id_referensi' => $pengembalian->id
            ]);
        });

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }
    public function edit($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.alat', 'peminjaman.user')->findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi_kembali' => 'required|in:baik,rusak,hilang'
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = $pengembalian->peminjaman;
        
        // 🔹 Validasi jumlah kembali tidak melebihi yang dipinjam
        if ($request->jumlah_kembali > $peminjaman->jumlah_pinjam) {
             return back()->with('error', 'Jumlah kembali melebihi jumlah pinjam');
        }

        // 🔹 Hitung ulang keterlambatan & denda
        $terlambat = Carbon::parse($request->tanggal_kembali)
            ->gt(Carbon::parse($peminjaman->tanggal_rencana_kembali));
        
        $status = $terlambat ? 'terlambat' : 'tepat waktu';
        $denda = 0;
        
        if ($terlambat) {
            $hari = Carbon::parse($peminjaman->tanggal_rencana_kembali)
                ->diffInDays(Carbon::parse($request->tanggal_kembali));
            $denda = $hari * 5000;
        }

        // 🔹 Update Stok Alat (Selisih)
        // Jika jumlah baru > lama, stok bertambah. Jika baru < lama, stok berkurang.
        $selisih = $request->jumlah_kembali - $pengembalian->jumlah_kembali;
        $peminjaman->alat->increment('jumlah_tersedia', $selisih);

        // 🔹 Update Pengembalian
        $pengembalian->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_kembali' => $request->jumlah_kembali,
            'kondisi_kembali' => $request->kondisi_kembali,
            'denda' => $denda,
            'status_pengembalian' => $status
        ]);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengupdate Pengembalian',
            'tabel_terkait' => 'pengembalians',
            'id_referensi' => $pengembalian->id
        ]);

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = $pengembalian->peminjaman;
        $id_deleted = $pengembalian->id;

        // 🔹 Kembalikan Stok (Kurangi stok karena pengembalian dibatalkan)
        $peminjaman->alat->decrement('jumlah_tersedia', $pengembalian->jumlah_kembali);

        // 🔹 Kembalikan Status Peminjaman ke 'dipinjam'
        $peminjaman->update([
            'status_peminjaman' => 'dipinjam'
        ]);

        $pengembalian->delete();

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus Pengembalian',
            'tabel_terkait' => 'pengembalians',
            'id_referensi' => $id_deleted
        ]);

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }

    public function print()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.alat', 'petugas')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pengembalian.cetak', compact('pengembalians'));
        return $pdf->download('laporan-pengembalian.pdf');
    }
}
