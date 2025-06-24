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
         
        // Apply sorting
        switch ($sort) {
            case 'rating':
                $query->orderBy('rating', 'desc');
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
    
    // Ambil comments dengan pagination
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
    //Upload Resep
    /**
     * Menampilkan form untuk membuat resep baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = ['Appetizer', 'Main Course', 'Dessert', 'Drinks'];
        return view('recipes.create', compact('categories'));
    }

    /**
     * Menyimpan resep baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // MAX 5MB = 5 * 1024 KB = 5120 KB
            'title' => 'required|string|max:255',
            'category' => 'required|in:Appetizer,Main Course,Dessert,Drinks',
            'description' => 'required|string',
            'cooking_time' => 'required|integer|min:1', // Durasi memasak minimal 1 menit
            'ingredients' => 'required|array|min:1', // Pastikan minimal ada 1 bahan
            'ingredients.*' => 'required|string|max:255', // Setiap elemen array ingredients adalah string wajib
            'instructions_list' => 'required|array|min:1', // Pastikan minimal ada 1 langkah
            'instructions_list.*' => 'required|string', // Validasi untuk setiap nama langkah
            'video_url' => 'nullable|url|sometimes', //optional video URL
            'action' => 'required|string|in:draft,publish', // Untuk status
        ], [
            // error messages
            'image.required' => 'Gambar resep wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan hanya JPG, PNG, atau JPEG.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'title.required' => 'Nama resep wajib diisi.',
            'category.required' => 'Kategori resep wajib dipilih.',
            'category.in' => 'Kategori resep tidak valid.',
            'description.required' => 'Deskripsi resep wajib diisi.',
            'cooking_time.required' => 'Durasi memasak wajib diisi.',
            'cooking_time.integer' => 'Durasi memasak harus berupa angka.',
            'cooking_time.min' => 'Durasi memasak minimal 1 menit.',
            'ingredients.required' => 'Minimal satu bahan wajib diisi.',
            'ingredients.min' => 'Minimal satu bahan wajib diisi.',
            'ingredients.*.required' => 'Bahan wajib diisi untuk setiap baris bahan.',
            'instructions_list.required' => 'Minimal satu langkah memasak wajib diisi.',
            'instructions_list.min' => 'Minimal satu langkah memasak wajib diisi.',
            'instructions_list.*.required' => 'Langkah-langkah memasak wajib diisi untuk setiap langkah.',
            'video_url.url' => 'Format URL video tutorial tidak valid.',
        ]);

        // Upload gambar
        $imageFile = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $imageFile->move(public_path('images/recipes'), $imageName);
        $imagePath = 'images/recipes/' . $imageName;

        $ingredients = $validatedData['ingredients'];
        $instructions = $validatedData['instructions_list'];

        Recipe::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
            'category' => $validatedData['category'],
            'cooking_time' => $validatedData['cooking_time'],
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'video_url' => $validatedData['video_url'] ?? null,
            'status' => $validatedData['action'],
        ]);

        return redirect()->route('home')->with('success', 'Resep berhasil diunggah!');
    }
}