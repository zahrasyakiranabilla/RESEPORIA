<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Comment;
use App\Models\Saran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalRecipes = Recipe::count();
        $totalUsers = User::count();
        $totalComments = Comment::count();
        $totalSaran = Saran::count();
        
        // Stats array untuk view dashboard - LENGKAP dengan semua key
        $stats = [
            'total' => $totalRecipes,
            'today' => Recipe::whereDate('created_at', today())->count(),
            'this_week' => Recipe::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Recipe::whereMonth('created_at', now()->month)->count(),
            'users' => $totalUsers,
            'comments' => $totalComments,
            'saran' => $totalSaran,
        ];
        
        // Data untuk grafik/chart - resep per bulan (6 bulan terakhir)
        $recipesByMonth = Recipe::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();
        
        // Resep terbaru (5 terakhir)
        $latestRecipes = Recipe::latest()
            ->limit(6)
            ->get();
        
        // User terbaru (5 terakhir)
        $latestUsers = User::latest()
            ->limit(5)
            ->get();
        
        // TAMBAH INI - Comments untuk dashboard
        $comments = Comment::with('recipe')->latest()->limit(10)->get();
        
        // Resep paling populer berdasarkan likes (kolom likes langsung)
        $popularRecipes = Recipe::orderBy('likes', 'desc')
            ->limit(5)
            ->get();
        
        // Statistik aktivitas hari ini
        $todayStats = [
            'recipes' => Recipe::whereDate('created_at', today())->count(),
            'users' => User::whereDate('created_at', today())->count(),
            'comments' => Comment::whereDate('created_at', today())->count(),
            'saran' => Saran::whereDate('created_at', today())->count(),
        ];
        
        return view('admin.dashboard.index', compact(
            'totalRecipes',
            'totalUsers', 
            'totalComments',
            'totalSaran',
            'stats',
            'comments', // TAMBAH INI
            'recipesByMonth',
            'latestRecipes',
            'latestUsers',
            'popularRecipes',
            'todayStats'
        ));
    }
}