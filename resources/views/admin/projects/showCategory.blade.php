@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}

    @if (session('delete_success'))
        @php
            $project = session('delete_success')
        @endphp
        <div class="alert alert-danger">
            "{{ $project->name }}" è stato correttamente spostato nel cestino!
    
        </div>
    @endif

    @if (session('restore_success'))
        @php
            $project = session('restore_success')
        @endphp
        <div class="alert alert-success">
            "{{ $project->name }}" è stato correttamente ripristinato!
            
        </div>
    @endif

    <a href="{{ route('admin.projects.index') }}" class="btn btn-dark my-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/></svg>
    </a>
    
    
    <h1 class="m-3">Modifica i tuo prodotti</h1>
        <div class="row ">

            <a class="btn my-btn btn-success my-1 w-25 m-auto" href="{{ route('admin.projects.create') }}">Nuovo</a>
            <a class="btn my-btn btn-danger my-1 w-25 m-auto" href="{{ route('admin.projects.trashed') }}">Cestino</a>
        </div>

        <div class="myproj-c my-4">

            @foreach ($projects as $project)

            @if($project->visible == 0)
            <div class="myproj">
            @else 
           
            <div class="myproj-off">
          
            @endif

                    <section class="s1">
                        <h4>{{$project->name}}</h4>
                        <span class="cat">{{$project->category->name}}</span>
                        <img class="my-image" src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}">
                    </section>
                    <section class="expire-mobile s2">
                        <h5>Ingredienti:</h5>
                        <p>
                            @foreach ($project->tags as $tag)
                                <span>{{ $tag->name }}</span>{{ !$loop->last ? ', ' : '.' }}
                            @endforeach
                        </p>
                        <div class="price">€{{$project->price / 100}}</div>
                    </section>
                    <section class="s3">
                        <a class="btn my-btn btn-warning w-100" href="{{ route('admin.projects.edit', ['project' =>$project]) }}">Modifica</a>
                            <form class="w-100" action="{{ route('admin.projects.destroy', ['project' =>$project])}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger w-100" >Elimina</button>
                            </form>
                            @if($project->visible == 0)
                            <form class="w-100" action="{{ route('admin.projects.updatestatus', $project->slug)}}" method="post">
                                @csrf

                                <button class="btn btn-warning w-100" >Nascondi</button>
                            </form>
                            @else 
                            <form class="w-100" action="{{ route('admin.projects.updatestatus', $project->slug)}}" method="post">
                                @csrf

                                <button class="btn btn-success w-100" >Mostra</button>
                            </form>
                          
                            @endif
                    </section>
                </div>

            
            @endforeach
        </div>
  

    {{ $projects->links() }}
@endsection

