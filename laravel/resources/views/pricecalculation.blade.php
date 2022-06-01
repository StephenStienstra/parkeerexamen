@extends('layouts.app')

@section('content')

@foreach ($prices as $price)

{{$price['prijs']}}
{{$price['kenteken']}}
{{$price['ID_Parkeerplaats']}}
{{$price['begintijd']}}
<br>

@endforeach

@endsection
