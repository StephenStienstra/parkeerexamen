@extends('layouts.app')

@section('content')
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>

    <form method="POST" action="/dashboardcustomer">@csrf
        <label for="customer">Selecteer welke klant u bent.</label>
           <select id="customer" name="customer">
                <option value="" disabled selected>Selecteer klant</option>
                @foreach($transactions as $customer)
                    <option id="{{$customer->ID_Klant}}" value="{{$customer->ID_Klant}}">{{$customer->klantnaam}}</option>
                @endforeach
            </select>
            <label for="numberboards" >Nummerborden</label>
            <select id="numberboards" name="numberboard"></select>

    </form>

    <table>
        <tr>
            <th>
                <td>klantnaam</td>
                <td>Kenteken</td>
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
                <td>{{$transaction->klantnaam}}</td>
                <td>{{$transaction->kenteken}}</td>
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
