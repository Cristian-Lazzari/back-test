@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <h1 class=" m-auto my-5">PRENOTAZIONI TAVOLI</h1>
    <a  href="{{ route('admin.months.index') }}" class="btn btn-warning w-50 m-auto my-3  d-block">Gestione date</a>
    <a  href="{{ route('admin.reservations.create') }}" class="btn btn-success w-50 m-auto my-3 d-block">Nuova Prenotazione</a>

    <p class="d-inline-flex gap-1">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
            </svg>  FILTRA
        </a>
       
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="{{ route('admin.reservations.filters')}}" class="filter" method="GET" class="mb-2">
                <h3 class="w-100">Filtri</h3>
                <div>

                    <label for="name" class="form-label">Nome Cliente</label>
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
        
                <div>
                    <label for="status" class="form-label">Stato</label>
                    <select
                        class="form-select w-auto"
                        id="status"
                        name="status"
                    >
                        <option 
                            @if (!isset($status))
                                selected
                            @endif
                            value="" 
                        >Tutti</option>
                        <option 
                            @if (isset($status) && $status == '0')
                                selected
                            @endif value="0"
                        >In Elaborazione</option>
                        <option 
                            @if (isset($status) && $status == '1')
                                selected
                            @endif value="1"
                        >Confermati</option>
                        <option 
                            @if (isset($status) && $status == '2')
                                selected
                            @endif value="2"
                        >Annullati</option>
                    </select>
                </div>
                <div>

                    <label for="date_reservation" class="form-label">Ordina per data</label>
                    <select
                        class="form-select w-auto"
                        id="date_reservation"
                        name="date_reservation"
                    >
                        <option 
                            @if (isset($date_reservation) && $date_reservation == '0')
                                selected
                            @endif
                            value="0"
                        >Ordina per data di creazione</option>
                        <option 
                            @if (isset($date_reservation) && $date_reservation == '1')
                                selected
                            @endif
                            value="1"
                        >Ordina per data di prenotazione</option>
                    </select>
                </div>

                <div>
              
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="true" aria-controls="collapseWidthExample">
                        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" name="dateok">
                        <label class="btn btn-outline-primary" for="btncheck1">Filtra per data</label>
                    </div>
       
             
                    <div style="min-height: 100px;">
                      <div class="collapse collapse-horizontal" id="collapseWidthExample">
                        <div class="card card-body mt-2" style="width: 150px;">
                            
                            <input 
                                type="date" 
                                name="selected_date" 
                                id="selected_date" 
                                class="form-control w-auto" 
                                @if (isset($selected_date))
                                    value="{{ $selected_date }}"  
                                @endif
                            >
                          
                        </div>
                      </div>
                    </div>
                </div>
        
                <button class="btn btn-primary w-100" type="submit">APPLICA FILTRI</button>
            </form>
        </div>
    </div>
    

    <a class="btn btn-success m-2" href="{{ route('admin.reservations.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
    </svg> RIMUOVI FILTRI</a>


    <div class="myres-c">

        @foreach ($reservations as $reservation)
        <?php

        $data_ora = DateTime::createFromFormat('d/m/Y H:i', $reservation->date_slot);

        $ora_formatata = $data_ora->format('H:i');
        $data_formatata = $data_ora->format('d/m/Y');
        $giorno_settimana = $data_ora->format('l');
        ?>



        @if ($reservation->status == 0)
                            
        <div class="myres el">
        @elseif ($reservation->status == 1)
        <div class="myres co">

        @elseif ($reservation->status == 2)

        <div class="myres an">
        @endif

            <div class="mail-tel">
                <div class="mail">{{$reservation->email}}</div>
                <div class="tel">{{$reservation->phone}}</div>
            </div>
            <div class="body">
                <section class="myres-left">
                    <div class="name">{{$reservation->name}}</div>
                    <div  class="myres-left-c">
                        <div class="time">{{$ora_formatata}}</div>

                        <div class="day_w">{{$giorno_settimana}}</div>
                        <div class="date">{{$data_formatata}}</div>
                    </div>
                    <div class="c_a">inviato alle: {{$reservation->created_at}}</div>
                </section>
                <section class="myres-center-res">
                   <h5>Numero di Ospiti</h5> 
                    <h4>{{$reservation->n_person}}</h4>
                </section>
                <section class="myres-right">

                    <form class="d-inline w-100 " action="{{ route('admin.reservations.confirmReservation', $reservation->id) }}" method="post">
                        @csrf
                        <button value="1" class="w-100 btn btn-warning">
                            Conferma
                        </button>
                    </form>
                    <form class="d-inline w-100" action="{{ route('admin.reservations.rejectReservation', $reservation->id) }}" method="post">
                        @csrf
                        <button value="2" class="w-100 btn btn-danger">
                            Annulla
                        </button>
                    </form>
                </section>
            </div>
            <div class="visible">
                @if ($reservation->status == 0)
                    
                <span>in elaborazione</span>
                @elseif ($reservation->status == 1)
                <span>confermato</span>
                
                @elseif ($reservation->status == 2)
                
                <span>annullato</span>
                @endif

            </div>
        </div>

        
        @endforeach
    </div>
  

    {{-- <div class="row">
        <h1 >PRENOTAZIONI TAVOLI</h1>
        
    </div>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th style="max-width:60px">NOME</th>
                    <th class="expire-mobile-s">TELEFONO</th>
                    <th class="expire-mobile">MESSAGGIO</th>
                    <th class="expire-mobile-s">N OSPITI</th>
                    <th class="expire-mobile-s">DATA</th>
                    <th class="expire-mobile-s">ORARIO</th>
                    <th>STATUS</th>
                    <th>conferma</th>
                    <th>annulla</th>


                    <th class="expire-mobile-s"></th>

                </tr>
            </thead>
            <tbody class="body-cat">
                @foreach ($reservations->reverse() as $reservation)
                    <tr>

                        <td class="name-mobile">
                            <a style="color:white; white-space:wrap" class="ts bs a-notlink badge bg-success rounded-pill " href="{{ route('admin.reservations.show', ['reservation' =>$reservation]) }}" > {{$reservation->name}}</a>
                           
                        </td>
                        <td class="expire-mobile-s">{{$reservation->phone}}</td>
                        <td class="expire-mobile-s">{{$reservation->message}}</td>
                        <td class="expire-mobile">{{$reservation->n_person}}</td>
                        <td class="expire-mobile-s">{{substr($reservation->date_slot, 0, -6)}}</td>
                        <td class="expire-mobile-s">{{substr($reservation->date_slot, 11)}}</td>
                        <td>
                            @if($reservation->status == 1)

                                <span class="badge bg-success">Completato</span> 
                                
                            @elseif($reservation->status == 2)    

                                <span class="badge bg-danger">Annullato</span> 

                            @else

                                <span class="badge bg-warning">In Elaborazione</span> 
                                
                            @endif
                            
                        
                        </td>
                        <td>
                            <form class="d-inline" action="{{ route('admin.reservations.confirmReservation', $reservation->id) }}" method="post">
                                @csrf
                                <button value="1" class="expire-mobile-s btn btn-warning">
                                    Conferma
                                </button>
                            </form>
                            <form class="d-inline" action="{{ route('admin.reservations.rejectReservation', $reservation->id) }}" method="post">
                                @csrf
                                <button value="2" class="expire-mobile-s btn btn-danger">
                                    Annulla
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    {{ $reservations->links() }}
@endsection