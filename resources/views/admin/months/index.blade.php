@extends('layouts.base')

@section('contents')

    <?php 
    // '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '16:30', '17:00', '17:30', '18:00', '18:30',
    $times = [
        1 => ['time' => '19:00', 'set' => ''] ,
        2 => ['time' => '19:15', 'set' => ''] ,
        3 => ['time' => '19:30', 'set' => ''] ,
        4 => ['time' => '19:45', 'set' => ''] ,
        5 => ['time' => '20:00', 'set' => ''] ,
        6 => ['time' => '20:15', 'set' => ''] ,
        7 => ['time' => '20:30', 'set' => ''] ,
    ]; 
    $days = [1, 2, 3, 4, 5, 6, 7];
    $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];
?>

<div class="row">
    <h1 >GESTIONE DATE</h1>
    <a  href="{{ route('admin.setting') }}" class="btn btn-dark">INDIETRO</a>
</div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form per runnare il seeder --}}
    <form class="d-flex flex-column py-5"  action="{{ route('admin.dates.runSeeder') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>GENERA NUOVE DATE</h3>
        <h5 class="pt-4">Indica il numero di posti a sedere per fascia oraria</h5>
        {{-- <div class="input-group flex-nowrap py-2">
            <label for="max_reservations" class="input-group-text" >N° di posti a sedere</label>
            <input name="max_reservations" id="max_reservations" type="number" class="form-control" placeholder="N° di posti a sedere" aria-label="N° di posti a sedere" aria-describedby="addon-wrapping" value="0">
          </div>
        <div> --}}
        <input name="max_reservations"  type="hidden" value="0">

        <h5 class="pt-4">Indica il numero massimo di ordini per l'asporto</h5>
        <div class="input-group flex-nowrap py-2">
            <label for="max_asporto" class="input-group-text" >N° di ordini</label>
            <input name="max_asporto" id="max_asporto" type="number" class="form-control" placeholder="N° di pezzi" aria-label="N° di pezzi" aria-describedby="addon-wrapping" value="0">
          </div>
        <div>

        <h5 class="pt-4">Indica il numero massimo ordini con consegna a domicilio</h5>
        <div class="input-group flex-nowrap py-2">
            <label for="max_domicilio" class="input-group-text" >N° di oridini a domicilio</label>
            <input name="max_domicilio" id="max_domicilio" type="number" class="form-control" placeholder="N° di pezzi" aria-label="N° di pezzi" aria-describedby="addon-wrapping" value="0">
          </div>
        <div>
            <h5 class="pt-4">Seleziona i giorni in cui sei attivo</h5>
            <div class="btn-group py-1 row g-2 " role="group" aria-label="Basic checkbox toggle button group">

                @foreach ($days as $day)
                
                    <input class="btn-check"  name="day_off[]" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample{{$day}}" aria-expanded="false" aria-controls="multiCollapseExample{{$day}}" id="day_off_{{ $day }}" value="{{ $day }}">
                    <label class="btn btn-dark radius col" for="day_off_{{ $day }}">{{ $days_name[$day] }}
                        <div class="collapse multi-collapse" id="multiCollapseExample{{$day}}">
                            <div class="card card-body">
                                <input
                                    type="checkbox"
                                    class="btn-check @error ('tags') is-invalid @enderror"
                                    id="days_off_{{ $day }}"
                                    name="days_off[]"
                                    value="{{ $day }}">
                                 
                    
                                
                                <label class="btn btn-outline-dark" for="days_off_{{ $day }}">Attiva</label>
{{--                                                            
                                <label class="btn btn-outline-primary " for="days_off_{{ $day }}">Attiva</label>
                                <input class="btn-check" type="checkbox" name="days_off[]" id="days_off_{{ $day }}" value="{{ $day }}"> --}}
                                
                                <h5 class="p-3">Seleziona le fasce orarie disponibili</h5>
                                @foreach ($times as $time)                            
                                
                                <select  class="form-select col" name="times_slot_{{$day}}[]" id="">
                                    <option value="0">{{ $time['time'] }} - ND</option>
                                    <option value="1">{{ $time['time'] }} - asporto</option>
                                    {{-- <option value="2">{{ $time['time'] }} - tavoli</option> --}}
                                    {{-- <option value="3">{{ $time['time'] }} - asporto/tavoli</option> --}}
                                    <option value="4">{{ $time['time'] }} - domicilio</option>
                                    {{-- <option value="5">{{ $time['time'] }} - domicilio/asporto</option> --}}
                                    {{-- <option value="6">{{ $time['time'] }} - domicilio/tavoli</option> --}}
                                    <option value="7">{{ $time['time'] }} - tutti</option>
                                </select>
                                
                                @endforeach                    
                            
                            </div>
                        </div>
                       
                   
                    </label>

                @endforeach
            </div>
        </div>
        

        <button class="btn btn-dark mt-4">Modifica</button>
    </form>

        <hr>


    <h1 class="my-4">SCEGLI UN MESE</h1>    
        <table class="table table-striped">
            <thead>
                <tr>
                   
                    <th>MESE</th>

                   
                </tr>
            </thead>
            <tbody>
                @foreach ($months as $month)
                    <tr>
                        
                        <td>
                            <a href="{{ route('admin.days.index', ['month' =>$month->n, 'year' =>$month->y ,'month_id' =>$month->id])  }}" style="color:white" class="ts bs a-notlink badge bg-primary rounded-pill"  > {{$month->month}} / {{$month->y}}</a >
                           
                        </td>
                    
                       
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $months->links() }}
@endsection

