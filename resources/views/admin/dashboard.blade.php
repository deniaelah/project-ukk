@extends('admin.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard Ringkasan</li>
    </ol>
    
    {{-- Baris Kartu Statistik --}}
    <div class="row">
        {{-- Kartu Alat --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h3 mb-0">{{ $total_alat }}</div>
                            <div class="small">Jenis Alat</div>
                        </div>
                        <i class="fas fa-tools fa-2x opacity-50"></i>
                    </div>
                    <div class="small mt-2">Total Stok: {{ $total_stok }} Unit</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('alat.index') }}">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu User --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h3 mb-0">{{ $total_user }}</div>
                            <div class="small">Total User</div>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('user.index') }}">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu Dipinjam --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h3 mb-0">{{ $sedang_dipinjam }}</div>
                            <div class="small">Sedang Dipinjam</div>
                        </div>
                        <i class="fas fa-hand-holding fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('peminjaman.index') }}">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu Selesai --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h3 mb-0">{{ $selesai_dikembalikan }}</div>
                            <div class="small">Selesai Dikembalikan</div>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('pengembalian.index') }}">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Aktivitas Terkini --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Aktivitas Peminjaman Terkini
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_peminjaman as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $item->user->name ?? 'User Terhapus' }}</td>
                            <td>{{ $item->alat->nama_alat ?? 'Alat Terhapus' }}</td>
                            <td>{{ $item->jumlah_pinjam }}</td>
                            <td>
                                <span class="badge 
                                    @if($item->status_peminjaman == 'menunggu') bg-warning
                                    @elseif($item->status_peminjaman == 'dipinjam') bg-primary
                                    @elseif($item->status_peminjaman == 'selesai') bg-success
                                    @elseif($item->status_peminjaman == 'ditolak') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($item->status_peminjaman) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada aktivitas peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection