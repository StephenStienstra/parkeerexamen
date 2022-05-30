@extends('layouts.app')

@section('content')
<div class="container">
    <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>
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
                <form method="POST" action="/home">@csrf<div id="map"></div></form>

                <script src="{{ asset('js/map.js') }}"></script>
                @foreach ($locations as $location)
                    <script>
                        L.marker([{{$location->latitude}}, {{$location->longitude}}]).addTo(map)
                        .bindPopup(
                            `
                            <div class="row">
                                <p class="col-xs-1 center-block text-center">Naam: {{ $location->parkeerplaatsnaam}}<br> Aantal plaatsen: {{ $location->aantalplekken}}<br> Postcode: {{ $location->postcode}}<br></p>
                                <div class="col-xs-1 center-block text-center">
                                    <input type="hidden" name="latitude" value="{{$location->latitude}}">
                                    <input type="hidden" name="longitude" value="{{$location->longitude}}">
                                    <input type="hidden" name="name" value="{{$location->parkeerplaatsnaam}}">
                                    <input type="submit" class="btn btn-primary" name="{{$location->ID_parkeerplaats}}" value="Start parkeren">
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
