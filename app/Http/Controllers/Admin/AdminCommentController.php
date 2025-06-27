<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of comments
     */
    public function index(Request $request)
    {
        $query = Comment::with(['recipe']); // Load recipe relationship only

        // Search functionality - cari di comment content dan user_name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%");
            });
        }

        // Filter by rating (sesuai view yang ada dropdown rating)
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort - tambahkan sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        $validSorts = ['created_at', 'rating', 'user_name'];
        if (in_array($sortBy, $validSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $comments = $query->paginate(20);

        // Stats for dashboard - SESUAI DENGAN VIEW
        $stats = [
            'total' => Comment::count(),
            'today' => Comment::whereDate('created_at', today())->count(),
            'this_week' => Comment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Comment::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.comments.index', compact('comments', 'stats'));
    }

    /**
     * Remove the specified comment
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus komentar: ' . $e->getMessage());
        }
    }
}