<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
      }
      .register-card {
        max-width: 450px;
        margin: auto;
        margin-top: 60px;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 12px;
      }
      .register-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .register-header img {
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
      <div class="register-card bg-white p-4">
        <div class="register-header">
          <h4 class="fw-bold text-dark">Registrasi Akun</h4>
          <p class="text-muted">Isi data lengkap kamu ya Bro~</p>
        </div>

        <form action="{{ route('register.submit') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label text-dark">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-dark">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-dark">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email aktif" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-dark">Password</label>
            <div class="input-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Buat password" required>
              <span class="input-group-text bg-white">
                <i class="bi bi-eye" id="togglePassword" style="cursor: pointer;"></i>
              </span>
            </div>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-brand text-white">Register</button>
          </div>
        </form>

        <div class="text-center small mt-3">
          Sudah punya akun?
          <a href="/login" class="text-decoration-none text-danger">Login di sini</a>
        </div>
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
