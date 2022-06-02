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
    <table class="sortable" style="width: 95%;" border="1px black" align="center">
        <thead>
            <tr>
                <th>parkeerplaats</th>
                <th>Kenteken</th>
                <th>plaatsnaam</th>
                <th>Begintijd</th>
                <th>prijs</th>
            </tr>
        </thead>
        @if ($transactions === NULL)
            <p>is Leeg</p>
        @else
        <tbody>
        @foreach ($transactions as $transaction)
            <tr class="trans" onclick="showTransaction(this)">
                <td>{{$transaction->parkeerplaatsnaam}}</td>
                <td>{{$transaction->kenteken}}</td>
                <td>{{$transaction->plaatsnaam}}</td>
                <td>{{$transaction->begintijd}}</td>
                <td>{{$transaction->prijs}}</td>
                <td hidden class="transinfo">{{$transaction->gemeentenaam}}</td>
                <td hidden class="transinfo">{{$transaction->provincienaam}}</td>
                <td hidden class="transinfo">{{$transaction->eindtijd}}</td>
                <td hidden class="transinfo">{{$transaction->adres}}</td>
                <td hidden class="transinfo">{{$transaction->postcode}}</td>

                <!--<td hidden>{/{$transaction->klantnaam}}</td>-->
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

    <script>
        function showTransaction(x) {
            $index = x.rowIndex;
            alert("klantnaam: " + $transactions[$index]["ID_Parkeerplaats"]);

        }


    // functie om de gekozen Klant ID door te sturen.
    $(document).ready(function(){

        // Klant ID wordt uit de Modal gehaald, in een Data variable gezet
        $(document).on('click', '.get_klantid', function (){
            console.log("test1");
            var data = {
                'klantid': $('.klantid').val().toString()
            }
            console.log(data);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token' : $('meta[name="_token"]').attr('content')
                }
            });

            // Data voor de Klant ID wordt in een ajax gegooid
            $.ajax({
                type: "POST",
                url: "/dashboardcustomer",
                data: data,
            });
            console.log("test3");

        });
    });
    </script>

@endsection
