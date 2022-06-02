@extends('layouts.app')

@section('content')
    <style>
        thead{
            font-weight: bold;
        }
        tr{
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            height: 30px;
        }
        .trans:hover{
                background-color: grey;
            }

        .transinfo{
        display: block;
        clear:both;
        }
    </style>


    <table class="sortable" style="width: 95%;" border="1px black" align="center">
        <thead>
            <tr>
                <th>beheerder</th>
                <th>parkeerplaats</th>
                <th>adres</th>
                <th>postcode</th>
                <th>plaatsnaam</th>
                <th>gemeentenaam</th>
                <th>provincienaam</th>
                <th>Begintijd</th>
                <th>Eindtijd</th>
                <th>prijs</th>
            </tr>
        </thead>
        </tbody>
        @foreach ($transactions as $transaction)
            <tr class="trans">
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
        </tbody>
    </table>

@endsection
