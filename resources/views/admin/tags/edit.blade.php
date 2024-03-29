@extends('layouts.base')

@section('contents')


<form class="cont_a" method="POST" action="{{ route('admin.tags.update', ['tag' => $tag]) }}" novalidate>
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Titolo</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name',$tag->name) }}"
        >
        <div class="invalid-feedback">
            @error('name') {{ $message }} @enderror
        </div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Prezzo in centesimi</label>
        <input
            type="text"
            class="form-control @error('price') is-invalid @enderror"
            id="price"
            name="price"
            value="{{ old('price',$tag->price) }}"
        >
        <div class="invalid-feedback">
            @error('price') {{ $message }} @enderror
        </div>
    </div>

   

    <button class="btn btn-primary">Salva</button>
</form>

@endsection