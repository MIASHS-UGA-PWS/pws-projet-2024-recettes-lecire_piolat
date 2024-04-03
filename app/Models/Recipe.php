<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Recipe extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the recipe.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the comments for the recipe.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The tags that belong to the recipe.
     * it's a many to many relationship -> we don't have to create a model for the recipe_tag table
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * The ingredients that belong to the recipe.
     * It's a many to many relationship -> we don't have to create a model for the ingredient_recipe table
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    /**
     * Get the ratings for the recipe.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}
