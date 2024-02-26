@extends('layouts.base')

@section('contents')
    @php
    $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
    @endphp

    @if (session('reserv_success'))
    <div class="alert alert-success">
        Ordine avvenuto correttamente!
    </div>
    @endif


    <form action="{{ route('admin.orders.store') }}" enctype="multipart/form-data" method="POST" class="p-5">
        @csrf
        @if (session('max_res_check'))
            <div class="alert alert-danger">
               <h3 for="max_check">Stai superando il limite di pezzi disponibili per tuesta data!</h3>
               <h4 for="max_check">Vuoi continuare comunque?</h4>
               
               <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check" id="btncheck1" name="max_check" autocomplete="off">
                <label class="btn btn-outline-danger" for="btncheck1">Continua</label>
              
               
              </div>
             
              <button class="btn  w-75 m-auto btn-primary d-block">Salva</button>
            </div>
        @endif

        <div class="mb-5">
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['name'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="phone" class="form-label">Telefono</label>
            <input
                type="text"
                class="form-control @error('phone') is-invalid @enderror"
                id="phone"
                name="phone"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['phone'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('phone') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="email" class="form-label">Email * opzionale</label>
            <input
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                @if (session('inputValues.email'))
                    value="{{ session('inputValues')['email'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('email') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="total_pz_q" class="form-label">N° di pezzi al taglio</label>
            <input
                type="number"
                class="form-control @error('total_pz_q') is-invalid @enderror"
                id="total_pz_q"
                name="total_pz_q"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['total_pz_q'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('total_pz_q') {{ $message }} @enderror
            </div>
        </div>
        <div class="mb-5">
            <label for="total_pz_t" class="form-label">N° di pizze al piatto</label>
            <input
                type="number"
                class="form-control @error('total_pz_t') is-invalid @enderror"
                id="total_pz_t"
                name="total_pz_t"
                value="0"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['total_pz_t'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('total_pz_t') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="total_price" class="form-label">Prezzo totale - in centesimi * opzionale</label>
            <input
                type="number"
                class="form-control @error('total_price') is-invalid @enderror"
                id="total_price"
                name="total_price"
                value="0"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['total_price'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('total_price') {{ $message }} @enderror
            </div>
        </div>
        <div class="mb-3 ">
            <label for="address" class="form-label">Comune (se con consena a domicilio)</label>
            <select
                class="form-select @error('address_id') is-invalid @enderror"
                id="address"
                name="address_id"
            >
            <option value="0">Nessuno</option>
                @foreach ($addresses as $address)
                    <option value="{{ $address->comune }}">{{ $address->comune }}</option>
                @endforeach
            </select>
            @error('address_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="indirizzo" class="form-label">Indirizzo (se con consena a domicilio)</label>
            <input
                type="text"
                class="form-control @error('indirizzo') is-invalid @enderror"
                id="indirizzo"
                name="indirizzo"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['indirizzo'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('indirizzo') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="civico" class="form-label">civico (se con consena a domicilio)</label>
            <input
                type="text"
                class="form-control @error('civico') is-invalid @enderror"
                id="civico"
                name="civico"
                @if (session('inputValues'))
                    value="{{ session('inputValues')['civico'] }}"
                @endif
            >
            <div class="invalid-feedback">
                @error('civico') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="message" class="form-label">Messaggio</label>
            <textarea 
                class="form-control" 
                name="message" 
                id="message" 
                cols="30" 
                rows="10"
            > 
            @if (isset(session('inputValues')['message']))
                {{ session('inputValues')['message'] }}
            @endif
            </textarea>
            <div class="invalid-feedback">
                @error('message') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn mb-5 w-75 m-auto btn-primary d-block">Salva</button>
        <div class="mb-5 m-auto w-50 btn-group specialradio" role="group" aria-label="Basic radio toggle button group"> 

            @foreach ($dates as $date)
            
            <input 
                type="radio" 
                class="btn-check" 
                name="date_id[]" 
                value="{{$date->id}}" 
                id="btnradio{{$date->id}}"
                @if (session()->has('inputValues.date_id') && in_array($date->id, session('inputValues.date_id')))
                    checked
                @endif
            >
            <label class="btn btn-outline-dark" for="btnradio{{$date->id}}">
                {{$date->time}} | {{$date->day}}/{{$date->month}}/{{$date->year}} | 
                disp. taglio <strong>{{$date->max_pz_q - $date->reserved_pz_q}}</strong> |
                disp. piatto <strong>{{$date->max_pz_t - $date->reserved_pz_t}}</strong> 
            </label>

            @endforeach
        </div>
     
  
        <button class="btn  w-75 m-auto btn-primary d-block">Salva</button>

    </form>
    
@endsection