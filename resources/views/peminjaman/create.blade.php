@extends('admin.admin')

@section('content')
<div class="container">
    <h2>Tambah Peminjaman</h2>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Alat</label>
            <select name="alat_id" class="form-control" required>
                <option value="">-- Pilih Alat --</option>
                @foreach ($alats as $alat)
                    <option value="{{ $alat->id }}">
                        {{ $alat->nama_alat }} (Stok: {{ $alat->jumlah_tersedia }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rencana Kembali</label>
            <input type="date" name="tanggal_rencana_kembali" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
