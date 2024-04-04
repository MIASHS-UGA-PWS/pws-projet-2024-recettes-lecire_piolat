<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\Recipe;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display a list of all recipes title and userid in admin list
        $recipes = Recipe::all();

      //  dd($recipes->toArray());

        //return AdminRecettes.vue
        return Inertia::render('AdminRecettes', [
            'recipes' => $recipes
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get to a create a new recipe page
       // return view('admin/create');

       //return AdminRecettes.vue
         return Inertia::render('AdminCreateRecette');

    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            // 'ingredients' => 'required',
            //price is a number, is min 0, and is not required
            'price' => 'numeric|min:0'
        ]);

        //store the recipe
        $recipe = new Recipe;
//USER ID CODE EN DUR
        $recipe->user_id = 1;
        $recipe->title = $request->input('title');
        $recipe->content = $request->input('content');
        $recipe->price = $request->input('price');
        $recipe->url = $request->input('title');
        $recipe->save();

        //return the same vue with success message
        return redirect()->route('admin.recettes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Montre un formulaire pour editer une recette
     */
    public function edit(string $id)
    {
        // Get the recipe and its associated ingredients
        $recipe = Recipe::with(['tags', 'ingredients'])->where('id', $id)->first();

        // Extract ingredient names and convert them to a comma-separated string
        // $ingredientNames = $recipe->ingredients->pluck('name')->implode(', ');

        // Pass the recipe and ingredient names to the view
        return Inertia::render('AdminEditRecette', [
            'recipe' => $recipe,
            // 'ingredientNames' => $ingredientNames,
        ]);
    }

    /**
     * Met à jour la recette dans la base de données
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'price' => 'numeric|min:0'
            //il faut gérer les ingrédients. voir AdminEditRecette.vue
        ]);

        // Validation passed, update the recipe
        $recipe = Recipe::find($id);
        $recipe->title = $validatedData['title'];
        $recipe->content = $validatedData['content'];
        $recipe->price = $validatedData['price'];
        $recipe->save();

        //return the same vue with success message
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete $id recipe
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect('/admin/recettes');

    }
}
