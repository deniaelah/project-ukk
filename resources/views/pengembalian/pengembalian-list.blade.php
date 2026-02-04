@extends('admin.admin')

@section('content')
<div class="container">
    <h2 class="mb-3">Data Pengembalian Alat</h2>

    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <a href="{{ route('pengembalian.print') }}" class="btn btn-success mb-3" target="_blank">Cetak Laporan</a>
    @endif


    {{-- <a href="{{ route('pengembalian.create') }}" class="btn btn-primary mb-3">
        + Tambah Pengembalian
    </a> --}}

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal Kembali</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Diproses Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($pengembalians as $pengembalian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $pengembalian->peminjaman->user->name ?? '-' }}
                        </td>

                        <td>
                            {{ $pengembalian->peminjaman->alat->nama_alat ?? '-' }}
                        </td>

                        <td>{{ $pengembalian->tanggal_kembali }}</td>
                        <td>{{ $pengembalian->jumlah_kembali }}</td>

                        <td>
                            <span class="badge 
                                @if($pengembalian->kondisi_kembali == 'baik') bg-success
                                @elseif($pengembalian->kondisi_kembali == 'rusak') bg-warning
                                @else bg-danger
                                @endif">
                                {{ ucfirst($pengembalian->kondisi_kembali) }}
                            </span>
                        </td>

                        <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>

                        <td>
                            <span class="badge 
                                {{ $pengembalian->status_pengembalian == 'tepat waktu' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($pengembalian->status_pengembalian) }}
                            </span>
                        </td>

                        <td>
                            {{ $pengembalian->petugas->name ?? '-' }}
                        </td>
                        <td>
                            <a href="{{ route('pengembalian.edit', $pengembalian->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            Data pengembalian belum ada
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
