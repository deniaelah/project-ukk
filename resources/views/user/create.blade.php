@extends('admin.admin')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>TAMBAH USER</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>NAMA</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label>USERNAME</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    </div>

                    <div class="mb-3">
                        <label>EMAIL</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label>PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="mb-3">
                        <label>ROLE</label>
                        <select name="role" class="form-select" required>
                            <option value="">Pilih role</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="peminjam">Peminjam</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
