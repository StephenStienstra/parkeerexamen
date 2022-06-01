@extends('layouts.app')

@section('content')
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>

    @if (session('message'))
        <div class="alert alert-succes" >{{session('message')}}</div>
    @endif



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/home">@csrf
                    <label for="customer">Selecteer welke klant u bent.</label>
                        <select id="customer" name="ID_Klant">
                            <option value="" disabled selected>Selecteer klant</option>
                            @foreach($customers as $customer)
                                <option id="{{$customer->ID_Klant}}" value="{{$customer->ID_Klant}}">{{$customer->klantnaam}}</option>
                            @endforeach
                        </select>
                    <label for="numberboards" >Nummerborden</label>
                        <select id="numberboards" name="kenteken">
                        </select>

                    <div class="" id="endsessionbutton">


                    </div>

                    <div id="map"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')


<script src="{{ asset('js/map.js') }}"></script>

@foreach ($locations as $location)
    <script>
        L.marker([{{$location->latitude}}, {{$location->longitude}}]).addTo(map)
        .bindPopup(
            `
            <div class="row">
                <p class="col-xs-1 center-block text-center">
                    Adres: {{ $location->adres}}<br>
                    Postcode: {{ $location->postcode}}<br>
                    Aantal plekken: {{ $location->aantalplekken}}<br>
                </p>
                <div class="col-xs-1 center-block text-center">
                    <input type="hidden" name="ID_Parkeerplaats" value="{{$location->ID_Parkeerplaats}}">
                    <input type="submit" class="btn btn-primary" value="Start parkeren">

                </div>
            </div>
            `
            )
        .openPopup();
    </script>
@endforeach

@endsection
