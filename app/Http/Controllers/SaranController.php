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
        $request->validate([
            'message' => 'required|min:5'
        ]);

        Saran::create([
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas masukan dan saran Anda!');
    }
}
