<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
      }
      .login-card {
        max-width: 400px;
        margin: auto;
        margin-top: 60px;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 12px;
      }
      .login-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .login-header img {
        width: 80px;
      }
      .btn-brand {
        background-color: #e60000;
        border: none;
      }
      .btn-brand:hover {
        background-color: #c40000;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="login-card bg-white p-4">
        <div class="login-header">
          <h4 class="fw-bold text-dark">Selamat Datang</h4>
          <p class="text-muted">Silakan login untuk melanjutkan</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label text-dark">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Masukkan email Anda" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label text-dark">Password</label>
            <div class="input-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
              <span class="input-group-text bg-white">
                <i class="bi bi-eye" id="togglePassword" style="cursor: pointer;"></i>
              </span>
            </div>
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-brand text-white">Login</button>
          </div>

          <div class="text-center small mt-3">
          Belum punya akun?
          <a href="/register" class="text-decoration-none text-danger">Register di sini</a>
        </div>
        </form>

        @if(session('Gagal'))
          <div class="alert alert-danger text-center py-2 small" role="alert">
            {{ session('Gagal') }}
          </div>
        @endif
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Password Script -->
    <script>
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

      togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
      });
    </script>
  </body>
</html>
