@extends('layouts.app')

@section('content')

@foreach ($prices as $price)

Prijs: €{{$price['prijs']}}
Kentkenen: {{$price['kenteken']}}
ID Parkeerplaats: {{$price['ID_Parkeerplaats']}}
Begintijd: {{$price['begintijd']}}
Eindtijd: {{$price['eindtijd']}}

<br>

@endforeach

@endsection
