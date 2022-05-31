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
                <td>beheerder</td>
                <td>parkeerplaats</td>
                <td>adres</td>
                <td>postcode</td>
                <td>plaatsnaam</td>
                <td>gemeentenaam</td>
                <td>provincienaam</td>
                <td>Begintijd</td>
                <td>Eindtijd</td>
                <td>prijs</td>
            </th>
        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{$transaction->beheerdernaam}}</td>
                <td>{{$transaction->parkeerplaatsnaam}}</td>
                <td>{{$transaction->adres}}</td>
                <td>{{$transaction->postcode}}</td>
                <td>{{$transaction->plaatsnaam}}</td>
                <td>{{$transaction->gemeentenaam}}</td>
                <td>{{$transaction->provincienaam}}</td>
                <td>{{$transaction->begintijd}}</td>
                <td>{{$transaction->eindtijd}}</td>
                <td>{{$transaction->prijs}}</td>
            </tr>
        @endforeach
    </table>

@endsection
