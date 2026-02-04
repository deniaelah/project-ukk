<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="/admin">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Core</div>
            @if (Auth::user()->role == 'admin')
            <a class="nav-link" href="{{ route('user.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-nurse"></i></div>
                User
            </a>
            <a class="nav-link" href="{{ route('kategori.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                Kategori
            </a>
            @endif

            <a class="nav-link" href="{{ route('alat.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                Alat
            </a>
            <a class="nav-link" href="{{ route('peminjaman.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelopes-bulk"></i></div>
                Peminjaman
            </a>
            <a class="nav-link" href="{{ route('pengembalian.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelopes-bulk"></i></div>
                Pengembalian
            </a>

            @if (Auth::user()->role == 'admin')
            <a class="nav-link" href="{{ route('log_aktivitas.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelopes-bulk"></i></div>
                Log aktivitas
            </a>
            @endif
            

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name ?? 'Guest' }}
    </div>
</nav>
