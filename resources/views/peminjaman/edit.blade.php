@extends('admin.admin')

@section('content')
<div class="container">
    <h2>Edit Peminjaman</h2>

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Alat</label>
            <select name="alat_id" class="form-control" required>
                @foreach ($alats as $alat)
                    <option value="{{ $alat->id }}"
                        {{ $alat->id == $peminjaman->alat_id ? 'selected' : '' }}>
                        {{ $alat->nama_alat }} (Stok: {{ $alat->jumlah_tersedia }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date"
                   name="tanggal_pinjam"
                   class="form-control"
                   value="{{ $peminjaman->tanggal_pinjam }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Rencana Kembali</label>
            <input type="date"
                   name="tanggal_rencana_kembali"
                   class="form-control"
                   value="{{ $peminjaman->tanggal_rencana_kembali }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number"
                   name="jumlah_pinjam"
                   class="form-control"
                   min="1"
                   value="{{ $peminjaman->jumlah_pinjam }}"
                   required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
