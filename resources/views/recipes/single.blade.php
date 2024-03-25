@extends('layouts/main')
{{-- on décide de ne pas display de titre ici, vu qu'il y a deja le titre "Recettes" --}}
@section('title', '')

@section('content')
<br>
<style>
    .btn {
        background-color: #f5f5f5;
        color: #363636;
        border: 1px solid #363636;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #a5a5a5;
        color: #000000;
    }

    .box { /* Style the boxes. used for comments, input fields, textareas */
        border: 1px solid #f5f5f5;
        padding: 20px;
        margin-bottom: 20px;
    }
    .box:hover {
        border: 1px solid #363636;
    }

    .textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .textarea:hover {
        border: 1px solid #363636;
    }
    .formulaire {
        margin: 30px 0;
    }

</style>

    <div class="columns is-multiline">
        {{-- classe is-offset-1 pour ajouter une margin a gauche, donc centrer le texte.
            classe is-10 : la div prend 10 colonnes de large sur 12--}}
        <div class="column is-offset-1 is-10">
            <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
            {{-- href to the recipe url. link made grey instead of blue --}}
            <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
            </a>
            {{-- cherche dans la table user la colonne name.
                possible pcq on a defini la relation entre recipe et user dans les modeles --}}
            <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>
            {{-- display "ingredients : " et la liste des ingredients --}}
            <p class="subtitle has-text-grey"><strong>Ingredients : {{ $recipe->ingredients }}</strong></p>
            <p class="subtitle has-text-grey">{{ $recipe->content }}</p>
        </div>
    </div>
    <br><br>


    <div class="columns is-multiline">
        <div class="column is-offset-1 is-10">
            {{-- commentaires, avec entre parenthèses le nb de commentaires à afficher --}}
            <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Commentaires ({{ $recipe->comments->count() }})</h2>

            <div class="formulaire">
                <form action="{{ url('comment') }}" method="post">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="field">
                        <div class="control">
                            <label class=subtitle>Ajoutez un commentaire</label><br>
                            <textarea class="textarea" name="content" placeholder="Ecrivez votre commentaire"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn subtitle has-text-grey border-radius=5px">Envoyer</button>

                </form>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                <p style="color: green; font-style: italic; font-size: 18px;">{{ session('success') }}</p>
            </div>
            @endif
            <br>

            {{-- if the user is not logged in, display a message --}}
            {{-- @if ( !Auth::check() )
                <p class="subtitle has-text-grey"><em>Connectez-vous pour ajouter un commentaire</em></p>
            @endif --}}

            {{-- for each comment, display content, author and date. on pt faire ça pcq on a relié les models Recipe et Comment --}}
            @foreach ($recipe->comments as $comment)
                <div class="box">
                    <p class="is-size-5">{{ $comment->user->name }}</p>
                    <p><small class="has-text-grey-dark">{{ $comment->created_at }}</small></p>
                    <p>{{ $comment->content }}</p>

                </div>
            @endforeach
        </div>

@endsection
