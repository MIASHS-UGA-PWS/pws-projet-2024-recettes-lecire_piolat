<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\Recipe;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display a list of all recipes title and userid
        $recipes = Recipe::all(); //get all recipes
        return view('admin/recettes',array(
            'recipes' => $recipes
        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get to a create a new recipe page
        return view('admin/create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'ingredients' => 'required',
            //price is a number, is min 0, and is not required
            'price' => 'numeric|min:0'
        ]);

        //store the recipe
        $recipe = new Recipe;
        //QUEL USER ID METTRE?
        $recipe->user_id = 1;
        $recipe->title = $request->input('title');
        $recipe->content = $request->input('content');
        $recipe->ingredients = $request->input('ingredients');
        $recipe->price = $request->input('price');
        $recipe->url = $request->input('title');
        $recipe->save();
        return redirect('/admin/recettes')->with('success', 'Vous avez ajouté une recette avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get to a a new page to edit the recipe
        $recipe = Recipe::find($id);
        return view('admin/edit',array(
            'recipe' => $recipe
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update the recipe
        $recipe = Recipe::find($id);
           $recipe->title = $request->input('title');
           $recipe->content = $request->input('content');
           $recipe->ingredients = $request->input('ingredients');
           $recipe->price = $request->input('price');
           $recipe->save();
        return redirect('/admin/recettes')->with('success', 'Vous avez modifié la recette avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete $id recipe
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect('/admin/recettes')->with('success', 'Vous avez supprimé une recette avec succès');

    }
}
