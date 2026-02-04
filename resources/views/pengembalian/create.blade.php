@extends('admin.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Proses Pengembalian</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Detail Peminjaman</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td>Peminjam</td>
                            <td>: {{ $peminjaman->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Alat</td>
                            <td>: {{ $peminjaman->alat->nama_alat }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pinjam</td>
                            <td>: {{ $peminjaman->tanggal_pinjam }}</td>
                        </tr>
                        <tr>
                            <td>Rencana Kembali</td>
                            <td>: {{ $peminjaman->tanggal_rencana_kembali }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Pinjam</td>
                            <td>: {{ $peminjaman->jumlah_pinjam }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf
                <input type="hidden" name="peminjamen_id" value="{{ $peminjaman->id }}">

                <div class="form-group mb-3">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" 
                           value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Jumlah Kembali</label>
                    <input type="number" name="jumlah_kembali" class="form-control" 
                           max="{{ $peminjaman->jumlah_pinjam }}" 
                           value="{{ $peminjaman->jumlah_pinjam }}" required>
                    <small class="text-muted">Maksimal: {{ $peminjaman->jumlah_pinjam }}</small>
                </div>

                <div class="form-group mb-3">
                    <label>Kondisi Kembali</label>
                    <select name="kondisi_kembali" class="form-control" required>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
