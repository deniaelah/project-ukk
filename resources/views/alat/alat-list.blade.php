@extends('admin.admin')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h2>Daftar alat</h2>
            @if(Auth::user()->role != 'peminjam')
            <a href="{{route('alat.create')}}">Tambah alat</a>
            @endif
            @if (Session::has('Sukses'))
            <div class="alert">{{ Session::get('Sukses') }}</div>
        @endif

            <table class="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama alat</td>
                        <td>Kategori</td>
                        <td>Kode alat</td>
                        <td>Spesifikasi</td>
                        <td>Jumlah total</td>
                        <td>Jumlah tersedia</td>
                        <td>Kondisi</td>
                        <td>Status</td>
                        @if(Auth::user()->role != 'peminjam')
                        <td>Aksi</td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alats as $alat)
                        <tr>
                            <td>{{$alats->firstItem() + $loop->index}}</td>
                            <td>{{$alat->nama_alat}}</td>
                            <td>{{$alat->kategori->nama ?? '-'}}</td>
                            <td>{{$alat->kode_alat}}</td>
                            <td>{{$alat->spesifikasi}}</td>
                            <td>{{$alat->jumlah_total}}</td>
                            <td>{{$alat->jumlah_tersedia}}</td>
                            <td>{{$alat->kondisi}}</td>
                            <td>{{$alat->status}}</td>
                            @if(Auth::user()->role != 'peminjam')
                            <td>
                                <a href="{{route('alat.edit', $alat->id)}}">edit</a>
                                <form action="{{route('alat.delete', $alat->id )}}" method="POST" onsubmit="return confirm('yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$alats->links()}}
        </div>
    </div>
@endsection