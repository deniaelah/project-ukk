@extends('admin.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Log Aktivitas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Log Aktivitas</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Aktivitas Sistem
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>User (Aktor)</th>
                            <th>Aktivitas</th>
                            <th>Tabel Terkait</th>
                            <th>ID Referensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $loop->index }}</td>
                            <td>{{ $log->created_at->format('d M Y H:i:s') }}</td>
                            <td>
                                @if($log->user)
                                    {{ $log->user->name }}
                                    <span class="badge bg-secondary">{{ $log->user->role }}</span>
                                @else
                                    <span class="text-muted">User Terhapus</span>
                                @endif
                            </td>
                            <td>{{ $log->aktivitas }}</td>
                            <td>{{ $log->tabel_terkait ?? '-' }}</td>
                            <td>{{ $log->id_referensi ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada aktivitas tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
