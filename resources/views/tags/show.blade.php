@extends('layouts/main')

@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Recettes qui contiennent le tag : {{ $tagInfo }}</h1>
    <br>


    @if ($recipes->isEmpty())
        <p>No recipes found with the tag "{{ $tagInfo }}"</p>
    @else
        <div class="columns is-multiline">

            @foreach ($recipes as $recipe)

                <div class="column is-4 mb-5">
                    <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
                    <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                        <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
                    </a>
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
                    <br>
                     {{-- display les 250 premiers caractères de content, puis "...". il faut clicker sur Read more pour voir la suite--}}
                    <p class= "subtitle has-text-grey">{{ substr($recipe->content, 0, 250) }}...</p>

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

                    <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
