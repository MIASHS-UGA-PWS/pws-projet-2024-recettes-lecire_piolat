{{-- a form webpage where the administrator can create a new recipe and save it in the database
the form contains fields for the title, content, ingredients, and price of the recipe --}}
@extends('layouts/main')

@section('title', 'Création de recette')

@section('content')

<style>
    .form-group {
        margin-bottom: 20px; /* Add space between each form group */
    }

    .subtitle {
        display: block;
    }

    .message-textarea {
        width: 80%; /* Set the width of the message textarea to 80% */
    }

</style>

    <div class="container">
        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Créer la Recette</h1>

        <form action="{{ route('recettes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title" class="subtitle has-text-grey">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">Content</label>
                <textarea name="content" id="content" class="form-control message-textarea" required required rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingredients</label>
                <textarea name="ingredients" id="ingredients" class="form-control message-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div>
                <label for="image">Recipe Image:</label>
                <input type="file" name="image" id="image">
            </div>
            <br><button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Ajouter</button>
        </form>
    </div>
@endsection

