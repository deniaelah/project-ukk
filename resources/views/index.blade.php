<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Peminjaman Alat</title>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Peminjaman Alat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Dashboard</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<header class="py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Sistem Informasi Peminjaman Alat</h1>
        <p class="fs-5 mt-3">
            Kelola peminjaman dan pengembalian alat dengan cepat dan terstruktur.
        </p>
    </div>
</header>

<!-- DAFTAR ALAT -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4">Daftar Alat Tersedia</h2>

        <div class="row g-4">
            @forelse ($alats as $alat)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $alat->nama_alat }}</h5>

                            <p class="mb-1">
                                <strong>Kategori:</strong>
                                {{ $alat->kategori->nama ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Stok:</strong>
                                {{ $alat->jumlah_tersedia }}
                            </p>

                            <span class="badge 
                                {{ $alat->jumlah_tersedia > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $alat->jumlah_tersedia > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>

                        <div class="card-footer text-center bg-white">
                            @auth
                                @if ($alat->jumlah_tersedia > 0)
                                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
                                        Pinjam
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Tidak Tersedia
                                    </button>
                                @endif
                            @else
                                <a href="/login" class="btn btn-outline-primary btn-sm">
                                    Login untuk Pinjam
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data alat.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark py-4">
    <div class="container text-center text-white">
        <small>
            © {{ date('Y') }} Sistem Peminjaman Alat  
            <br> Dibuat dengan Laravel & Bootstrap
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
