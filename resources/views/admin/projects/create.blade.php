@extends('layouts.base')

@section('contents')

    <form 
        method="POST" action="{{ route('admin.projects.store') }} "
        enctype="multipart/form-data" 
        class="px-2 py-5 bg-danger  bg-opacity-75 rounded" 
    >
        @csrf

        <div class="mb-3 text-center nome_">
            <label for="name" class="form-label fw-semibold">Nome Prodotto</label>
            <input
                type="text"
                class="form-control w-75 m-auto text-center @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >
            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3 text-center prezzo_">
            <label for="price" class="form-label fw-semibold">Prezzo in centesimi</label>
            <input
                type="text"
                class="form-control w-75 m-auto text-center @error('price') is-invalid @enderror"
                id="price"
                name="price"
                value="{{ old('price') }}"
            >
            <div class="invalid-feedback">
                @error('price') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3 text-center categoria_">
            <label for="category" class="form-label fw-semibold">Categoria</label>
            <select
                class="form-select w-75 m-auto text-center @error('category_id') is-invalid @enderror"
                id="category"
                name="category_id"
            >
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group my-5 text-center w-50 m-auto">
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <label class="input-group-text  @error('image') is-invalid @enderror" for="image">Upload</label>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-5 m-auto w-75 btn-group specialradio">
            <h3>Ingredienti</h3>
            <div class="mytags">

                @foreach($tags as $tag)

                    <input
                        type="checkbox"
                        class="btn-check @error ('tags') is-invalid @enderror"
                        id="tag{{ $tag->id }}"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        @if (in_array($tag->id, old('tags', []))) checked @endif
            
                    >
                    <label class="btn btn-outline-dark" for="tag{{ $tag->id }}">{{ $tag->name }}</label>

                    @error('tags') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                
                @endforeach

            </div>
        </div>

        <div class="mb-3">
            <label for="name_ing" class="form-label">Titolo</label>
            <input
                type="text"
                class="form-control @error('name_ing') is-invalid @enderror"
                id="name_ing"
                name="name_ing"
                value="{{ old('name_ing') }}"
            >
            <div class="invalid-feedback">
                @error('name_ing') {{ $message }} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="price_ing" class="form-label">Prezzo in centesimi</label>
            <input
                type="text"
                class="form-control @error('price_ing') is-invalid @enderror"
                id="price_ing"
                name="price_ing"
                value="{{ old('price_ing') }}"
            >
            <div class="invalid-feedback">
                @error('price_ing') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn mb-5 w-75 m-auto btn-dark d-block">Salva</button>
    </form>
@endsection