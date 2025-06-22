<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Favorite;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        $recipes = $query->latest()->get();
        $categories = ['Appetizer', 'Main Course', 'Dessert', 'Drinks'];

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function category($category)
    {
        $categoryMap = [
            'appetizer' => 'Appetizer',
            'main-course' => 'Main Course',
            'dessert' => 'Dessert',
            'drinks' => 'Drinks'
        ];

        if (!isset($categoryMap[$category])) {
            abort(404);
        }

        $categoryName = $categoryMap[$category];
        
        // Get sort parameter
        $sort = request('sort', 'newest');
        
        $query = Recipe::where('category', $categoryName);
        
        // Apply sorting - update untuk menggunakan rating dari comments
        switch ($sort) {
            case 'rating':
                // Sort berdasarkan average rating dari comments
                $query->withCount(['comments as avg_rating' => function($q) {
                    $q->select(\DB::raw('coalesce(avg(rating), 0)'));
                }])->orderBy('avg_rating', 'desc');
                break;
            case 'likes':
                $query->orderBy('likes', 'desc');
                break;
            case 'time':
                $query->orderBy('cooking_time', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $recipes = $query->get();
        
        return view('recipes.category', compact('recipes', 'categoryName'));
    }

    public function show(Recipe $recipe)
    {
        $sessionId = session()->getId();
        $isFavorited = $recipe->isFavoritedBy($sessionId);

        return view('recipes.show', compact('recipe', 'isFavorited'));
        
        // Load comments dengan pagination
        $comments = $recipe->comments()->paginate(10);
        
        return view('recipes.show', compact('recipe', 'isFavorited', 'comments'));
    }

    public function like(Recipe $recipe)
    {
        $recipe->increment('likes');
        return response()->json(['likes' => $recipe->likes]);
    }

    public function toggleFavorite(Recipe $recipe)
    {
        $sessionId = session()->getId();

        $favorite = Favorite::where('session_id', $sessionId)
                           ->where('recipe_id', $recipe->id)
                           ->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorited = false;
        } else {
            Favorite::create([
                'session_id' => $sessionId,
                'recipe_id' => $recipe->id
            ]);
            $isFavorited = true;
        }

        return response()->json(['favorited' => $isFavorited]);
    }

    public function favorites()
    {
        $sessionId = session()->getId();
        $favorites = Favorite::where('session_id', $sessionId)
                            ->with('recipe')
                            ->get();

        $recipes = $favorites->pluck('recipe');

        return view('recipes.favorites', compact('recipes'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('home');
        }
        
        $recipes = Recipe::where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->orWhere('ingredients', 'LIKE', "%{$query}%")
              ->orWhere('instructions', 'LIKE', "%{$query}%");
        })->get();
        
        return view('recipes.search', compact('recipes', 'query'));
    }

    public function searchApi(Request $request)
    {
        $query = $request->get('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $recipes = Recipe::where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('ingredients', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%");
        })
        ->limit(8) // Limit results untuk performance
        ->get(['id', 'title', 'description', 'image', 'category', 'rating', 'likes', 'cooking_time']);

        return response()->json($recipes);
    }
}