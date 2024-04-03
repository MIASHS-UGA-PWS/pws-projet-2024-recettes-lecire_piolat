<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecettesController extends Controller
{
    function index(){
        // Get all recipes with their associated tags
        $recipes = Recipe::with('tags')->get();

        //methode compact pour passer plusieurs variables à la vue
        return view('recettes', compact('recipes'));
    }

    public function show($recipe_url) {
        // Fetch the recipe by its URL (or any unique identifier you're using)
        $recipe = Recipe::where('url', $recipe_url)->firstOrFail(); // Using firstOrFail to handle not found errors gracefully

        // Fetch tags associated with the recipe
        $tags = $recipe->tags()->pluck('name');

        // Calculate the average rating of the recipe
        $averageRating = $recipe->ratings()->avg('rating');

        // Convert the average rating to a format suitable for display (round it to the nearest half-star for display purposes)
        $averageRating = round($averageRating * 2) / 2;

        // Pass the recipe, tags, and averageRating to the view
        return view('recipes/single', compact('recipe', 'tags', 'averageRating'));
    }

    public function search(Request $request) {
        $search = $request->input('recipe');

        //search for recipes with the search term in the title or in the tags
        $recipes = Recipe::where('title', 'like', '%'.$search.'%')->get();

        //add the recipes with the search term in the tags
        $recipes = $recipes->merge(Recipe::whereHas('tags', function($q) use ($search) {
            $q->where('name', 'like', '%'.$search.'%');
        })->get());

        //add the recipes that have the search term in the ingredients. check ingredient_recipe table
        $recipes = $recipes->merge(Recipe::whereHas('ingredients', function($q) use ($search) {
            $q->where('name', 'like', '%'.$search.'%');
        })->get());


       //return the recettes view with the recipes
         return view('recettes', compact('recipes'));
    }
}
?>
