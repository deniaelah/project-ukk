@extends('admin.admin')

@section('content')
    <div class="container">
        <h2>Daftar Peminjaman</h2>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah</a>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <a href="{{ route('peminjaman.print') }}" class="btn btn-success" target="_blank">Cetak Laporan</a>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Status</th>
                    <th>Disetujui Oleh</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjamans->firstItem() + $loop->index }}</td>
                        <td>{{ $peminjaman->user->name }}</td>
                        <td>{{ $peminjaman->alat->nama_alat }}</td>
                        <td>{{ $peminjaman->jumlah_pinjam }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td>{{ $peminjaman->tanggal_rencana_kembali }}</td>
                        <td>
                            @if ($peminjaman->status_peminjaman == 'menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif ($peminjaman->status_peminjaman == 'dipinjam')
                                <span class="badge bg-success">Dipinjam</span>
                            @elseif ($peminjaman->status_peminjaman == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif ($peminjaman->status_peminjaman == 'disetujui')
                                <span class="badge bg-info">Disetujui</span>
                            @else
                                <span class="badge bg-secondary">
                                    {{ ucfirst($peminjaman->status_peminjaman) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($peminjaman->approver)
                                {{ $peminjaman->approver->name }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">

                            {{-- tombol approve / reject --}}
                            @if ($peminjaman->status_peminjaman == 'menunggu' && Auth::user()->role != 'peminjam')
                                <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST"
                                    style="display:inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm"
                                        onclick="return confirm('Setujui peminjaman ini?')">
                                        Setujui
                                    </button>
                                </form>

                                <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST"
                                    style="display:inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak peminjaman ini?')">
                                        Tolak
                                    </button>
                                </form>
                            @endif

                            {{-- tombol kembalikan --}}
                            @if ($peminjaman->status_peminjaman == 'dipinjam' && !$peminjaman->pengembalian)
                                <a href="{{ route('pengembalian.create', $peminjaman->id) }}" class="btn btn-info btn-sm">
                                    Kembalikan
                                </a>
                            @endif

                            {{-- jika sudah dikembalikan --}}
                            @if ($peminjaman->pengembalian)
                                <span class="badge bg-secondary">Selesai</span>
                            @endif

                            {{-- tombol edit & hapus (hanya jika menunggu/ditolak) --}}
                            @if ($peminjaman->status_peminjaman == 'menunggu' || $peminjaman->status_peminjaman == 'ditolak')
                                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{route('peminjaman.delete', $peminjaman->id)}}" method="POST" class="d-inline" onsubmit="return confirm('yakin hapus')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            Data peminjaman kosong
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $peminjamans->links() }}
    </div>
@endsection
