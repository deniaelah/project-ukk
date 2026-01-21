<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="/admin">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Core</div>
            {{-- <a class="nav-link" href="{{ route('peminjaman.index') }}"> --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                Kategori
            </a>
            {{-- <a class="nav-link" href="{{ route('produk.index') }}"> --}}
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                Produk
            </a>
            {{-- <a class="nav-link" href="{{ route('backend.resep.index') }}"> --}}
                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                Resep
            </a>
            {{-- <a class="nav-link" href="{{ route('backend.berita.index') }}"> --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelopes-bulk"></i></div>
                Berita
            </a>
            {{-- @if (Auth::user()->role == 'admin') --}}
                {{-- <a class="nav-link" href="{{ route('backend.user.index') }}"> --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-nurse"></i></div>
                User
            </a>
            {{-- @endif --}}

            {{-- <div class="sb-sidenav-menu-heading">Manajemen</div>
            <a class="nav-link" href="{{ route('teams.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Team
            </a>
            <a class="nav-link" href="{{ route('company.profile.check') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                Company Profile
            </a>
            <a class="nav-link" href="{{ route('certifications.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-certificate"></i></div>
                Sertifikasi
            </a>
            <a class="nav-link" href="{{ route('testimonials.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
                Testimoni
            </a> --}}
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name ?? 'Guest' }}
    </div>
</nav>
