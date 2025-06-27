<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    public function create()
    {
        return view('saran.create');
    }

    public function store(Request $request)
    {
        // Validasi message wajib
        $request->validate([
            'message' => 'required|min:5'
        ]);

        // Ambil data dari user yang login
        Saran::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'message' => $request->message,
            'is_read' => false
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas masukan dan saran Anda!');
    }
}