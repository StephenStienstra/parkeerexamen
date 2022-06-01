@extends('layouts.app')

@section('content')
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>


    @if ($klantID = NULL)
        {{$klantID}}
    @else
        {{$klantID}}
    @endif
    <!-- Vind klant ID Modal -->
    <div class="modal fade" id="KlantIDModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Klant ID</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="">klantID</label>
                    <input type="text" class="klantid form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary get_klantid">Selecteer</button>
               </div>
             </div>
            </div>
        </div>
    </div>
    <!-- Einde vind klant ID Modal -->

    <!-- button voor klantID -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Klant
                            <a href="#" data-bs-toggle="modal" data-bs-target="#KlantIDModal" class="btn btn-primary float-end btn-sm">Kies klant</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Einde button voor klantID -->

    <!--<form method="POST" action="/dashboardcustomer">@/csrf
        <label for="customer">Selecteer welke klant u bent.</label>
           <select id="customer" name="customer">
                <option value="" disabled selected>Selecteer klant</option>
                @/foreach($customers as $customer)
                    <option id="{/{$customer->ID_Klant}}" value="{/{$customer->ID_Klant}}">{/{$customer->klantnaam}}</option>
                @/endforeach
    </form>-->
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
        @if ($transactions == NULL)
            <tr><td>is Leeg</td></tr>
        @else
        @foreach ($transactions as $transaction)
            <tr onclick="showTransaction(this)">
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
        @endif
    </table>

    <script>
        function showTransaction(x) {
            $index = x.rowIndex;
            alert("klantnaam: " + $transactions[$index]["ID_Parkeerplaats"]);
        }


        // functie om de gekozen Klant ID door te sturen.
        $(document).ready(function(){

            // Klant ID wordt uit de Modal gehaald, in een Data variable gezet
            $(document).on('click', '.get_klantid', function (e){
                e.preventDefault();
                console.log("test1");
                var data = {
                    'klantid': $('.klantid').val().toString()
                }
                console.log(data);

                // Token voor verbinding
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Data voor de Klant ID wordt in een ajax gegooid
                $.ajax({
                    type: "POST",
                    url: "/dashboardcustomer",
                    data: data,
                    dataType: "json",
                });
                console.log("test3");

            });

        });

    </script>

@endsection
