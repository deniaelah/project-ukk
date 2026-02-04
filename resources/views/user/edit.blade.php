@extends('admin.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>EDIT USER</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>NAMA</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label>USERNAME</label>
                    <input type="text" name="username" class="form-control"
                        value="{{ old('username', $user->username) }}">
                </div>

                <div class="mb-3">
                    <label>EMAIL</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label>PASSWORD</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="Kosongkan jika tidak diubah">
                </div>

                <div class="mb-3">
                    <label>ROLE</label>
                    <select name="role" class="form-select" required>
                        <option value="">Pilih role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>
                        <option value="peminjam" {{ old('role', $user->role) == 'peminjam' ? 'selected' : '' }}>
                            Peminjam
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
