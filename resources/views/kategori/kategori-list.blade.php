@extends('admin.admin')

@section('content')
    <div class="container">
        <h2>Daftar Kategori</h2>
        <a href="{{ route('kategori.create') }}">Tambah</a>
        @if (Session::has('Sukses'))
            <div class="alert">{{ Session::get('Sukses') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>NAMA</td>
                    <td>DESKRIPSI</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $kategori)
            <tbody>
                <tr>
                    <td>{{ $kategoris->firstItem() + $loop->index }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->deskripsi }}</td>
                    <td>
                        <a href="{{route('kategori.edit', $kategori->id)}}">edit</a>
                        <form action="{{route('kategori.delete', $kategori->id)}}" method="POST" onsubmit="return confirm('yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @empty
            <tr>
                <td>Tidak ada data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
        {{$kategoris->links() }}
    </div>
@endsection
