@extends('admin.admin')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h3 class="mb-3">Tambah Alat</h3>

        <form action="{{ route('alat.store') }}" method="POST">
            @csrf

            {{-- kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- kode alat --}}
            <div class="mb-3">
                <label class="form-label">Kode Alat</label>
                <input type="text" name="kode_alat" class="form-control"
                       value="{{ old('kode_alat') }}">
            </div>

            {{-- nama alat --}}
            <div class="mb-3">
                <label class="form-label">Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control"
                       value="{{ old('nama_alat') }}" required>
            </div>

            {{-- spesifikasi --}}
            <div class="mb-3">
                <label class="form-label">Spesifikasi</label>
                <textarea name="spesifikasi" class="form-control" rows="3">{{ old('spesifikasi') }}</textarea>
            </div>

            {{-- jumlah total --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Total</label>
                <input type="number" name="jumlah_total" class="form-control"
                       value="{{ old('jumlah_total') }}" required>
            </div>

            {{-- jumlah tersedia --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Tersedia</label>
                <input type="number" name="jumlah_tersedia" class="form-control"
                       value="{{ old('jumlah_tersedia') }}" required>
            </div>

            {{-- kondisi --}}
            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-control">
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>

            {{-- status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="dipinjam">Dipinjam</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
