<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\log_aktivitas;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::orderBy('created_at', 'asc')->paginate(100);
        return view('user.user-list',compact('users'));
    }
    public function create(){
        return view('user.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menambah User',
            'tabel_terkait' => 'users',
            'id_referensi' => $user->id
        ]);

        return redirect()->route('user.index')->with('Sukses', 'user berhasil tambah');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }
    public function update(Request $request, $id){
         $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengedit User',
            'tabel_terkait' => 'users',
            'id_referensi' => $user->id
        ]);

        return redirect()->route('user.index')->with('Sukses', 'Berhasil edit');
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus User',
            'tabel_terkait' => 'users',
            'id_referensi' => $id
        ]);

        return redirect()->route('user.index')->with('Sukses', 'Berhasil hapus');
    }
}
