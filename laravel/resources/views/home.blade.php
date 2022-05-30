@extends('layouts.app')

@section('content')
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>
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

                <form method="POST" action="/home">@csrf
                    <label for="cars">Selecteer welke klant u bent.</label>
                        <select id="klant" name="klant">
                            @foreach($customers as $customer)
                                <option value="{{$customer->ID_Klant}}">{{$customer->klantnaam}}</option>
                            @endforeach
                        </select>
                    <div id="map"></div>
                </form>

                <script src="{{ asset('js/map.js') }}"></script>
                {{$customers[0]->klantnaam}}
                {{$numberboards[0]->kenteken}}

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
                                    <input type="hidden" name="latitude" value="{{$location->latitude}}">
                                    <input type="hidden" name="longitude" value="{{$location->longitude}}">
                                    <input type="hidden" name="name" value="{{$location->adres}}">
                                    <input type="submit" class="btn btn-primary" name="{{$location->id}}" value="Start parkeren">
                                </div>
                            </div>
                            `
                            )
                        .openPopup();
                    </script>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
