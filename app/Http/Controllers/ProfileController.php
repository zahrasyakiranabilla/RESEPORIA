<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan profil
    public function show()
    {
        $user = Auth::user();

        return view('profile.show');
    }

    // Halaman edit profil
    public function edit()
    {
        return view('profile.edit');
    }

    // Proses update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        // Update nama & email
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];


        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
