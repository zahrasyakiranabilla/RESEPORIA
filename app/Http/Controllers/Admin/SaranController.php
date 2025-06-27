<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    /**
     * Display a listing of saran
     */
    public function index(Request $request)
    {
        $query = Saran::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Sort by latest
        $saran = $query->latest()->paginate(10);

        // Stats for dashboard
        $stats = [
            'total' => Saran::count(),
            'today' => Saran::whereDate('created_at', today())->count(),
            'unread' => Saran::where('is_read', false)->count(),
        ];

        return view('admin.saran.index', compact('saran', 'stats'));
    }

    /**
     * Display the specified saran
     */
    public function show(Saran $saran)
    {
        // Mark as read otomatis ketika dibuka
        if (!$saran->is_read) {
            $saran->update(['is_read' => true]);
        }

        return view('admin.saran.show', compact('saran'));
    }

    /**
     * Mark saran as read
     */
    public function markAsRead(Saran $saran)
    {
        $saran->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Saran berhasil ditandai sebagai dibaca!');
    }

    /**
     * Remove the specified saran
     */
    public function destroy(Saran $saran)
    {
        try {
            $saran->delete();
            return redirect()->route('admin.saran.index')
                ->with('success', 'Saran berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.saran.index')
                ->with('error', 'Gagal menghapus saran: ' . $e->getMessage());
        }
    }
}