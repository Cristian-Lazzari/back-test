@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
   

    
    <h1 class="my-5">PRENOTAZIONI D'ASPORTO</h1>
    <a  href="{{ route('admin.months.index') }}" class="btn btn-warning w-50 m-auto my-3 d-block">Gestione date</a>
    <a  href="{{ route('admin.orders.create') }}" class="btn btn-success w-50 m-auto my-3 d-block">Nuovo Ordine</a>

    <form action="{{ route('admin.orders.filters')}}" method="GET" class="mb-2">
        <h3>Filtri</h3>

        <label for="name" class="form-label">Nome</label>
        <input
            type="text"
            class="form-control mb-2"
            id="name"
            name="name"
            @if (isset($name))
                value="{{ $name }}"  
            @endif
        >

        <label for="status" class="form-label">Stato</label>
        <select
            class="form-select"
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

        <label for="date_order" class="form-label">Ordina per data</label>
        <select
            class="form-select"
            id="date_order"
            name="date_order"
        >
            <option 
                @if (isset($date_order) && $date_order == '0')
                    selected
                @endif
                value=""
            >Ordina per data di creazione</option>
            <option 
                @if (isset($date_order) && $date_order == '1')
                    selected
                @endif
                value="1"
            >Ordina per data di prenotazione</option>
        </select>

        <label for="delivery" class="form-label">Filtra per domicilio</label>
        <select
            class="form-select"
            id="delivery"
            name="delivery"
        >
            <option 
                @if (isset($delivery) && $delivery == '0')
                    selected
                @endif
                value="0"
            >Ritiro in negozio</option>
            <option 
                @if (isset($delivery) && $delivery == '1')
                    selected
                @endif
                value="1"
            >Domicilio</option>
        </select>

        <label for="selected_date">Filtra per data</label>
        <input 
            type="date" 
            name="selected_date" 
            id="selected_date" 
            class="form-control" 
            @if (isset($selected_date))
                value="{{ $selected_date }}"  
            @endif
        >

        <button class="btn btn-primary" type="submit">Filtra</button>
    </form>

        <a class="btn btn-success" href="{{ route('admin.orders.index')}}">Non filtrare</a>

    <div class="myres-c">

        @foreach ($orders as $order)
        <?php

        $data_ora = DateTime::createFromFormat('d/m/Y H:i', $order->date_slot);

        $ora_formatata = $data_ora->format('H:i');
        $data_formatata = $data_ora->format('d/m/Y');
        $giorno_settimana = $data_ora->format('l');
        ?>



        @if ($order->status == 0)
                            
        <div class="myres el">
        @elseif ($order->status == 1)
        <div class="myres co">

        @elseif ($order->status == 2)

        <div class="myres an">
        @endif

            <div class="mail-tel">
                <div class="mail">{{$order->email}}</div>
                <div class="tel">{{$order->phone}}</div>
            </div>
            <div class="body">
                <section class="myres-left">
                    <div class="name">{{$order->name}}</div>
                    <div  class="myres-left-c">
                        <div class="time">{{$ora_formatata}}</div>

                        <div class="day_w">{{$giorno_settimana}}</div>
                        <div class="date">{{$data_formatata}}</div>
                    </div>
                    <div class="c_a">inviato alle: {{$order->created_at}}</div>
                </section>
                <section class="myres-center">
                    <h5>Prodotti</h5>

                    @foreach ($orderProject as $i)
                    
                    @if ($order->id == $i->order_id)
                    @foreach ($order->projects as $o)
                    
                        @if ($o->id == $i->project_id)
                        <?php $name= $o->name ?>
                        @endif
                        
                    @endforeach
                    <?php
                        $arrA= json_decode($i->addicted); 
                        $arrD= json_decode($i->deselected); 
                    ?>
                    <div class="product">
                        <div class="counter">* {{$i->quantity_item}}</div>              
                        <div class="name">{{$name}}</div>
                        <div class="variations">
                            <div class="add">
                          
                                @foreach ($arrA as $a)
                                <span>+ {{$a}}</span>
                                @endforeach
                               
                            </div>
                            <div class="removed">
                                
                             
                                @foreach ($arrD as $a)
                                <span>- {{$a}}</span>
                                @endforeach       
                                
                            </div>
                        </div>
                        
                    </div>
                    @endif
                    @endforeach
                    <div class="t_price">€{{$order->total_price / 100}}</div>
                    <div class="t_price">{{$order->total_pz_q}} pezzi taglio</div>
                    <div class="t_price">{{$order->total_pz_t}} pizze piatte</div>
                    
                </section>
                <section class="myres-right">

                    <form class="d-inline w-100 " action="{{ route('admin.orders.confirmOrder', $order->id) }}" method="post">
                        @csrf
                        <button value="1" class="w-100 btn btn-warning">
                            Conferma
                        </button>
                    </form>
                    <form class="d-inline w-100" action="{{ route('admin.orders.rejectOrder', $order->id) }}" method="post">
                        @csrf
                        <button value="2" class="w-100 btn btn-danger">
                            Annulla
                        </button>
                    </form>
                    @if ($order->indirizzo !== '0')
                    <h3>
                        Consegnare a domicilio
                        <p>{{$order->comune}}, {{$order->indirizzo}}, {{$order->civico}}</p>
                    </h3>
                    @else
                    <h3>
                        Ritiro d'asporto
                    </h3>
                    @endif
                </section>
            </div>
            <div class="visible">
                @if ($order->status == 0)
                    
                <span>in elaborazione</span>
                @elseif ($order->status == 1)
                <span>confermato</span>
                
                @elseif ($order->status == 2)
                
                <span>annullato</span>
                @endif

            </div>
        </div>

        
        @endforeach
    </div>
   


    {{ $orders->links() }}
@endsection