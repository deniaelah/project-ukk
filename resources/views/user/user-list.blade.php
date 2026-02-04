@extends('admin.admin')

@section('content')
<div class="container">
    <h2>Daftar User</h2>

    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
        Tambah User
    </a>

    @if (Session::has('Sukses'))
        <div class="alert alert-success">
            {{ Session::get('Sukses') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
                <td class="text-center">
                    <a href="{{ route('user.edit', $user->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('user.delete', $user->id) }}"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Data user kosong
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
