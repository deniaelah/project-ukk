<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/admin">Peminjaman Alat</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar (User Info) -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false">

                {{-- Nama + Role (rapat, agak jauh dari foto) --}}
                <div class="d-none d-sm-block text-end me-3" style="line-height: 1;">
                    <div class="fw-semibold text-white">{{ Auth::user()->name }}</div>
                    <small class="text-muted" style="font-size: 0.75rem;">
                        {{ ucfirst(Auth::user()->role) }}
                    </small>
                </div>

                {{-- Foto user --}}
                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-user.png') }}"
                     class="rounded-circle border" width="36" height="36" alt="User Photo">
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
