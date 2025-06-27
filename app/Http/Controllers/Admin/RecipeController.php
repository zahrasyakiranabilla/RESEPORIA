<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
     /**
     * Display a listing of recipes
     */
    public function index(Request $request)
    {
        $query = Recipe::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        $validSorts = ['title', 'category', 'created_at', 'likes'];
        if (in_array($sortBy, $validSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $recipes = $query->paginate(12);

        // Get categories for filter - ambil dari database yang ada
        $categories = Recipe::whereNotNull('category')
                          ->where('category', '!=', '')
                          ->distinct()
                          ->pluck('category')
                          ->filter()
                          ->sort()
                          ->values();

        // Jika categories kosong, berikan default categories
        if ($categories->isEmpty()) {
            $categories = collect(['appetizer', 'main-course', 'dessert', 'drinks']);
        }

        // Stats
        $stats = [
            'total' => Recipe::count(),
            'today' => Recipe::whereDate('created_at', today())->count(),
            'this_week' => Recipe::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Recipe::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.recipes.index', compact(
            'recipes', 
            'categories', 
            'stats'
        ));
    }

    /**
     * Display the specified recipe
     */
    public function show(Recipe $recipe)
    {
        // Get recipe stats
        $recipeStats = [
            'likes_count' => $recipe->likes ?? 0,
            'comments_count' => 0, // Set 0 dulu
            'views_count' => 0, // Set 0 dulu
        ];

        // Try to get comments count
        try {
            $recipeStats['comments_count'] = $recipe->comments()->count();
        } catch (\Exception $e) {
            $recipeStats['comments_count'] = 0;
        }

        return view('admin.recipes.show', compact('recipe', 'recipeStats'));
    }

    /**
     * Show the form for editing the specified recipe (Admin limited edit)
     */
    public function edit(Recipe $recipe)
    {
        $categories = ['appetizer', 'main-course', 'dessert', 'drinks']; 
        $statuses = ['draft', 'published', 'featured', 'rejected']; // Jika ada kolom status
        return view('admin.recipes.edit', compact('recipe', 'categories', 'statuses'));
    }

    /**
     * Update the specified recipe (Admin limited update)
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'category' => 'required|string',
            'status' => 'nullable|string|in:draft,published,featured,rejected',
            'is_featured' => 'nullable|boolean',
        ]);

        $data = [
            'category' => $request->category,
        ];

        // Update status jika ada kolom status
        if ($request->filled('status')) {
            try {
                $data['status'] = $request->status;
            } catch (\Exception $e) {
                // Skip jika tidak ada kolom status
            }
        }

        // Update featured jika ada kolom is_featured
        if ($request->has('is_featured')) {
            try {
                $data['is_featured'] = $request->boolean('is_featured');
            } catch (\Exception $e) {
                // Skip jika tidak ada kolom is_featured
            }
        }

        $recipe->update($data);

        return redirect()->route('admin.recipes.show', $recipe)
            ->with('success', 'Pengaturan resep berhasil diupdate!');
    }

    /**
     * Approve recipe (jika ada fitur approval)
     */
    public function approve(Recipe $recipe)
    {
        try {
            $recipe->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Resep berhasil disetujui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Fitur approval belum tersedia!');
        }
    }

    /**
     * Reject recipe (jika ada fitur approval)
     */
    public function reject(Recipe $recipe)
    {
        try {
            $recipe->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Resep berhasil ditolak!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Fitur approval belum tersedia!');
        }
    }

    /**
     * Remove the specified recipe
     */
    public function destroy(Recipe $recipe)
    {
        try {
            // Delete image if exists
            if ($recipe->image && file_exists(storage_path('app/public/' . $recipe->image))) {
                unlink(storage_path('app/public/' . $recipe->image));
            }

            // Delete related data
            try {
                $recipe->comments()->delete();
                $recipe->favorites()->delete();
            } catch (\Exception $e) {
                // Skip jika tidak ada relasi
            }

            $recipe->delete();

            return redirect()->route('admin.recipes.index')
                ->with('success', 'Resep berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.recipes.index')
                ->with('error', 'Gagal menghapus resep: ' . $e->getMessage());
        }
    }
}