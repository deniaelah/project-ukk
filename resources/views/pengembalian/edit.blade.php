@extends('admin.admin')

@section('content')
<div class="container">
    <h2>Edit Data Pengembalian</h2>
    
    {{-- Note: Backend Logic for Update/Edit Pengembalian is not yet implemented in Controller/Routes --}}
    
    <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST"> 
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" 
                   value="{{ $pengembalian->tanggal_kembali }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Jumlah Kembali</label>
            <input type="number" name="jumlah_kembali" class="form-control" 
                   value="{{ $pengembalian->jumlah_kembali }}" 
                   max="{{ $pengembalian->peminjaman->jumlah_pinjam }}" required>
            <small class="text-muted">Max: {{ $pengembalian->peminjaman->jumlah_pinjam }}</small>
        </div>

        <div class="form-group mb-3">
            <label>Kondisi Kembali</label>
            <select name="kondisi_kembali" class="form-control" required>
                <option value="baik" {{ $pengembalian->kondisi_kembali == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $pengembalian->kondisi_kembali == 'rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="hilang" {{ $pengembalian->kondisi_kembali == 'hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
