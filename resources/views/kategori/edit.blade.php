@extends('admin.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>tambah kategori</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="nama" value="{{old('nama', $kategori->nama)}}">
                    </div>

                    <div class="mb-3">
                        <label for="">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{old('deskripsi', $kategori->deskripsi)}}">
                    </div>

                    <button type="submit">Simpan</button>
                    <a href="{{route('kategori.index')}}">batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
