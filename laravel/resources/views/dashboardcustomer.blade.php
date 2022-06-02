@extends('layouts.app')

@section('content')

    <label for="customer">Selecteer de klant:</label>


    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  name="customer" id="customer">
        <option value="" disabled selected>Selecteer klant</option>
        @foreach ($customers as $customer)
            <option id="{{$customer->ID_Klant}}" value="./{{$customer->ID_Klant}}"><a href="./{{$customer->ID_Klant}}">{{$customer->klantnaam}}</a></option>
        @endforeach
    </select>

    <br>
    <br>

    <table id="transactions" class="display">
        <thead>
            <tr>
                <th>Klantnaam</th>
                <th>parkeerplaats</th>
                <th>Kenteken</th>
                <th>plaatsnaam</th>
                <th>Begintijd</th>
                <th>prijs</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td >{{$transaction->klantnaam}}</td>
                <td>{{$transaction->parkeerplaatsnaam}}</td>
                <td>{{$transaction->kenteken}}</td>
                <td>{{$transaction->plaatsnaam}}</td>
                <td>{{$transaction->begintijd}}</td>
                <td>{{$transaction->prijs}}</td>
                <!-- <td>{/{$transaction->gemeentenaam}}</td>
                <td>{/{$transaction->provincienaam}}</td>
                <td>{/{$transaction->eindtijd}}</td>
                <td>{/{$transaction->adres}}</td>
                <td>{/{$transaction->postcode}}</td> -->

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
