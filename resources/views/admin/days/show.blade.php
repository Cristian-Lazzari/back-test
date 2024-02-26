@extends('layouts.base')

@section('contents')
@php
        $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
        @endphp


    
<h1 class="m-5">GESTISCI IL IL GIORNO</h1>    



        <div class="mydata">
            
            @foreach ($dates as $date)
            
            
          @php
              $status = ['','asporto','tavoli','asporto/tavoli','domicilio','domicilio/asporto','domicilio/tavoli','tutti']
          @endphp
                
                <div class="mycard">
                    <div class="left-c">
                        <div class="data">
                            <span>{{$status[$date['status']]}}</span>

                            <h2>{{$date->time}}</h2>
                            <span class="day_w">{{$days_name[$date->day_w]}}</span>
                            <span>{{$date->day}}/{{$date->month}}/{{$date->year}}</span>
                        </div>
                        <div class="res">
                            <h3>Pezzi al taglio Prenotati</h3>
                            <div class="n_res">{{$date->reserved_pz_q}}</div>    
                        </div>
                        <div class="res">
                            <h3>Pizze al piatto Prenotate</h3>
                            <div class="n_res">{{$date->reserved_pz_t}}</div>    
                        </div>
                        <div class="res">
                            <h3>Posti Prenotati</h3>
                            <div class="n_res">{{$date->reserved}}</div>
                        </div>
                    </div>
                    <div class="right-c">
                        <div class="max">
                            <h3>Max Posti</h3>
                            <form action="{{ route('admin.dates.upmaxres', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_res}}</span>

                            <form action="{{ route('admin.dates.downmaxres', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>
                        </div>
                        <div class="max">
                            <h3>Max Pezzi al taglio</h3>
                            <form action="{{ route('admin.dates.upmaxpz', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_pz_q}}</span>

                            <form action="{{ route('admin.dates.downmaxpz', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>

                        </div>
                        <div class="max">
                            <h3>Max Pizze al piatto</h3>
                            <form action="{{ route('admin.dates.upmaxpzt', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_pz_t}}</span>

                            <form action="{{ route('admin.dates.downmaxpzt', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>

                        </div>
                        <div class="max">
                            <h3>Max ordini domicilio</h3>
                            <form action="{{ route('admin.dates.upmaxpzd', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_domicilio}}</span>

                            <form action="{{ route('admin.dates.downmaxpzd', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>

                        </div>
                        
                    </div>
                    
                      
                    <div class="visible-on">
                        <span class="">{{ 'pz-q' . ' ' . ($date->visible_fq ? 'si' : 'no')}}</span> 
                        <span class="">{{ 'pz-t' . ' ' . ($date->visible_ft ? 'si' : 'no')}}</span> 
                        <span class="">{{ 'tavoli' . ' ' . ($date->visible_t ? 'si' : 'no')}}</span> 
                        <span class="">{{ 'domicilio' . ' ' . ($date->visible_d ? 'si' : 'no')}}</span> 
                      
                    </div>
               
{{--                         
                    <div class="visible">
                        <span class="">non visibile</span> 
                        
                        <form action="{{ route('admin.dates.updatestatus', $date->id) }}" method="post">
                            @csrf
                            <button class="btn btn-success">Modifica visibilità</button>
                        </form>
                        
                    </div> --}}
                  
                </div>
                        
                    
                    
                    
             
            @endforeach
     
        </div>

 

    
@endsection

