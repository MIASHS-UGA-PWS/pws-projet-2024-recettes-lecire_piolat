@extends('layouts/main')
@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Les 3 dernières recettes : </h1>
    <br>

    @if ( $recipes->isEmpty() )
        <p>No recipe found</p>

    @else
        <div class="columns is-multiline">

            {{-- for the first 3 recipes : --}}
            @foreach ( $recipes->take(3) as $recipe )

                <div class="column is-4 mb-5">
                <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
                {{-- href to the recipe url. link made grey instead of blue --}}
                <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                    <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
                </a>
                {{-- cherche dans la table user la colonne name. possible pcq on a defini la relation entre recipe et user dans les modeles --}}
                <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>

                {{-- display la liste des ingredients. de la table ingredient_recipe --}}
                <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> :</span>
                @foreach ($recipe->ingredients as $key => $ingredient)

                    {{-- si on clicke sur un ingrédient, on obtient la liste des recettes qui contiennent cet ingrédient dans le titre, tags ou dans les ingrédients --}}
                    <span><a class="subtitle has-text-grey" href="{{ url('recettes/search?recipe=' . $ingredient->name) }}">{{ $ingredient->name }}</a></span>

                    {{-- ajoute une virgule entre les ingredients, sauf si c'est le dernier --}}
                    @if (!$loop->last)
                        <span class="subtitle has-text-grey">,</span>
                    @endif
                @endforeach

                {{-- display le contenu de la recette --}}
                <br><br><p class="subtitle has-text-grey">{{ $recipe->content }}</p>

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

                {{-- href vers l'url de la recette. lien rendu gris au lieu de bleu --}}
                <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
