@extends('layouts.base')

@section('contents')

<div class="container mt-5" style="max-width: 900px">
    <div class="row gap-2">
        <a 
            class="col-12 flex-grow-1 col-md-2 border-secondary border-opacity-75 bs ts mybtn-1 bg-primary" 
            href="{{ route('admin.categories.index') }}"
        >
            Categorie
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-9 border-secondary border-opacity-75 bs ts mybtn-1 bg-primary" 
            href="{{ route('admin.projects.index') }}"
        >
            Prodotti
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-2 border-secondary border-opacity-75 bs ts mybtn-1 bg-primary" 
            href="{{ route('admin.tags.index') }}"
        >
            Ingredienti
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-9 border-secondary border-opacity-50 bs ts mybtn bg-warning" 
            href="{{ route('admin.reservations.index') }}"
        >
            Prenotazioni tavoli
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-7 border-secondary border-opacity-50 bs ts mybtn bg-warning" 
            href="{{ route('admin.orders.index') }}"
        >
            Orders
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-2 border-secondary border-opacity-25 bs ts mybtn-1 bg-success" 
            href="{{ route('admin.hashtags.index') }}"
        >
            Hashtag
        </a>

        <a 
            class="col-12 flex-grow-1 col-md-2 border-secondary border-opacity-25 bs ts mybtn-1 bg-success" 
            href="{{ route('admin.posts.index') }}"
        >
            Post
        </a>

        <a 
            class="col-12 col-md-9 offset-md-2 border-secondary border-opacity-75 mt-4 bs ts mybtn-1 bg-secondary" 
            href="{{ route('admin.setting') }}"
        >
            Settings
        </a>

    </div>
</div>


@endsection
