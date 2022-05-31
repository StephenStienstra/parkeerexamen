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

        {{$data}}
        <!--@/foreach ($data as $transactie)
        <tr>
            <td>{/{$transactie->ID_Parkeerplaats}}</td>
            <td>{/{$transactie->kenteken}}</td>
            <td>{/{$transactie->begintijd}}</td>
            <td>{/{$transactie->eindtijd}}</td>
            <td>{/{$transactie->adres}}</td>

        </tr>
    @/endforeach
    @/foreach ($transactions as $transaction)
        <tr>
            <td>{/{$transaction->ID_Parkeerplaats}}</td>
            <td>{/{$transaction->kenteken}}</td>
            <td>{/{$transaction->begintijd}}</td>
            <td>{/{$transaction->eindtijd}}</td>
            @/for(i=0; i<$location.length; i++)
                @/if($transaction->ID_Parkeerplaats = $location[i]['ID_Parkeeplaats'])
                    <td>{/{$location[i]['adres']}}</td>
            @/endfor
        </tr>
    @/endforeach-->
    </table>

@endsection
