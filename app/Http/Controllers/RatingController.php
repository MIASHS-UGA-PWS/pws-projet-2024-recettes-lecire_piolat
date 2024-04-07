<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function rateRecipe(Request $request) {

        // need user to be authenticated
        if (!auth()->check()) {
            return response()->json(['message' => 'Vous devez être connecté pour noter une recette'], 401);
        }

        // Validate the request
        $request->validate([
            'user_id' => 'required|integer',
            'recipe_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Update or create the rating
        Rating::updateOrCreate(
            ['user_id' => $request->user_id, 'recipe_id' => $request->recipe_id], // Where
            ['rating' => $request->rating] // Update
        );

        return response()->json(['message' => 'Mise à jour reussie du classement']);
    }


}
