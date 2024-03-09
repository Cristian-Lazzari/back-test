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
    
    
    <h1 class="m-3">Gestione prodotti</h1>
    <div class="d-flex align-items-center justify-content-between gap-4 py-3">

        <a class="btn my-btn btn-success my-1 flex-grow-1" href="{{ route('admin.projects.create') }}">
            Nuovo
        </a>
        <a class="btn my-btn btn-danger my-1 flex-grow-1" href="{{ route('admin.projects.trashed') }}">
            Cestino
        </a>

        {{-- FILTRA  --}}
        <a class="btn btn-primary my-1 flex-grow-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
            </svg>  FILTRA
        </a>

        {{-- RIMUOVI FILTRI  --}}
        <a class="btn btn-success my-1 flex-grow-1" href="{{ route('admin.projects.showCategory', $category_id)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
            </svg> RIMUOVI FILTRI
        </a>

    </div>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="{{ route('admin.projects.filter')}}" class="filter mb-2" method="GET">

                {{-- ID CATEGORIA --}}
                <input hidden type="number" name="category_id" value="{{ $category_id }}">

                {{-- NOME --}}
                <div>
                    <label for="name" class="form-label fw-semibold">Nome Prodotto</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        @if (isset($name))
                            value="{{ $name }}"  
                        @endif
                    >
                </div>

                {{-- VISIBILITà  --}}
                <div>
                    <label for="visible" class="form-label fw-semibold">Visibilità</label>
                    <select
                        class="form-select w-auto"
                        id="visible"
                        name="visible"
                    >
                        <option 
                            @if (isset($visible) && $visible == '0')
                                selected
                            @endif
                            value="0"
                        >Tutti</option>
                        <option 
                            @if (isset($visible) && $visible == '1')
                                selected
                            @endif
                            value="1"
                        >Visibili</option>
                        <option 
                            @if (isset($visible) && $visible == '2')
                                selected
                            @endif
                            value="2"
                        >Non visibili</option>
                    </select>
                </div>

                <button class="btn btn-primary w-100" type="submit">APPLICA FILTRI</button>
            </form>
        </div>
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
                    <a class="btn my-btn btn-warning w-100" href="{{ route('admin.projects.edit', $project->id) }}">Modifica</a>
                        <form class="w-100" action="{{ route('admin.projects.destroy', ['project' =>$project])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger w-100" >Elimina</button>
                        </form>
                        @if($project->visible == 0)
                        <form class="w-100" action="{{ route('admin.projects.updatestatus', $project->id)}}" method="post">
                            @csrf

                            <button class="btn btn-warning w-100" >Nascondi</button>
                        </form>
                        @else 
                        <form class="w-100" action="{{ route('admin.projects.updatestatus', $project->id)}}" method="post">
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

