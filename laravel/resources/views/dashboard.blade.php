@extends('layouts.app')

@section('content')


    <table id="transactions" class="display">
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
            <tr class>
                <td>{{$transaction->klantnaam}}</td>
                <td>{{$transaction->parkeerplaatsnaam}}</td>
                <td>{{$transaction->adres}}</td>
                <td>{{$transaction->postcode}}</td>
                <td>{{$transaction->plaatsnaam}}</td>
                <td>{{$transaction->gemeentenaam}}</td>
                <td>{{$transaction->provincienaam}}</td>
                <td>{{$transaction->begintijd}}</td>
                <td>{{$transaction->eindtijd}}</td>
                @foreach ($prices as $price)
                    @if ($price['ID_Parkeerplaats'] == $transaction['ID_Parkeerplaats'] && $price['kenteken'] == $transaction['kenteken'] && $price['begintijd'] == $transaction['begintijd'])
                            <td>{{$price['prijs']}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready( function () {
            $('#transactions').DataTable();
        });
    </script>

@endsection
