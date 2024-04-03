@extends('layouts/main')
{{-- on décide de ne pas afficher de titre ici, vu qu'il y a deja le titre "Recettes" --}}
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

    .checked {
        color: orange;
    }

</style>

    <div class="columns is-multiline">
        {{-- classe is-offset-1 pour ajouter une margin a gauche, donc centrer le texte.
            classe is-10 : la div prend 10 colonnes de large sur 12--}}
        <div class="column is-offset-1 is-10">
            <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>

            {{-- titre : href vers la recette. lien gris, pas bleu--}}
            <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
            </a>
            {{-- cherche dans la table user la colonne name. --}}
            <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>

            {{-- display la note moyenne de la recette avec un event listener pour chaque etoile --}}
            @for ($i = 1; $i <= 5; $i++)
                <span class="fa fa-star {{ $i <= $averageRating ? 'checked' : '' }}" onclick="rateRecipe({{ $i }})"></span>
            @endfor
            {{-- script pour envoyer la note de la recette au serveur --}}
            <script>
            function rateRecipe(rating) {
                fetch('/rate-recipe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        // user_id is always 1 until implementation of authentication
                        user_id: 1,
                        recipe_id: {{ $recipe->id }},
                        rating: rating
                    })
                })
                .then(response => response.json())
                .then(data => {
                    updateStars(rating); // update the stars
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
            function updateStars(rating) {
            const stars = document.querySelectorAll('.fa-star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('checked');
                } else {
                    star.classList.remove('checked');
                }
            });
            }
            </script>
            <br><br>

            {{-- display la liste des ingredients. de la table ingredient_recipe --}}
            <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> :</span>
                {{-- si on clicke sur un ingrédient, on obtient la liste des recettes qui contiennent cet ingrédient dans le titre, tags ou dans les ingrédients --}}
            @foreach ($recipe->ingredients as $key => $ingredient)

                <span><a class="subtitle has-text-grey" href="{{ url('recettes/search?recipe=' . $ingredient->name) }}">{{ $ingredient->name }}</a></span>

                {{-- ajoute une virgule entre les ingredients, sauf si c'est le dernier --}}
                @if (!$loop->last)
                    <span class="subtitle has-text-grey">,</span>
                @endif
            @endforeach
            {{-- display le contenu de la recette --}}
            <br><br>
            <p class="subtitle has-text-grey">{{ $recipe->content }}</p>

            {{-- display les tags. si pas de tags, affiche "pas de tags" --}}
            <p class="subtitle has-text-grey">
                <strong><em>Tags</em></strong> :
                @if ($recipe->tags->isEmpty())
                    <em>pas de tags</em>
                @else
                    @foreach ($recipe->tags as $tag)
                    <a href="{{ url('tags/' . $tag->name) }}">
                        <span class="tag" >{{ $tag->name }}</span>
                    </a>
                    @endforeach
                @endif
            </p>

        </div>
    </div>
    <br><br>


    <div class="columns is-multiline">
        <div class="column is-offset-1 is-10">
            {{-- commentaires, avec entre parenthèses le nb de commentaires à afficher --}}
            <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Commentaires ({{ $recipe->comments->count() }})</h2>

            <div class="formulaire">
                <form action="{{ url('comment') }}" method="post">
                    @csrf {{-- token de sécurité --}}
                    {{-- champ caché pour envoyer l'id de la recette avec le commentaire --}}
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="field">
                        <div class="control"> {{-- champ pour le contenu du commentaire --}}
                            <label class=subtitle>Ajoutez un commentaire</label><br>
                            <textarea class="textarea" name="content" placeholder="Ecrivez votre commentaire"></textarea>
                        </div>
                    </div> {{-- bouton pour envoyer le commentaire --}}
                    <button type="submit" class="btn subtitle has-text-grey border-radius=5px">Envoyer</button>
                </form>
            </div>

            @if (session('success')) {{-- si le commentaire a bien été ajouté, afficher un message de succès --}}
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
