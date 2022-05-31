@extends('layouts.app')

@section('content')
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>

    <table>
        <tr>
            <th>
                <td>ID</td>
                <td>Kenteken</td>
                <td>Begintijd</td>
                <td>Eindtijd</td>
                <td>adres</td>
            </th>
        </tr>

    @foreach ($transactions as $transaction)
        <tr>
            <td>{{$transaction->ID_Parkeerplaats}}</td>
            <td>{{$transaction->kenteken}}</td>
            <td>{{$transaction->begintijd}}</td>
            <td>{{$transaction->eindtijd}}</td>
            <td>{{$transaction->adres}}</td>
        </tr>
    @endforeach
    </table>

@endsection
