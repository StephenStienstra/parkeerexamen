<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSession;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ParkingController extends Controller
{

    public function HandleReservation(ParkingSession $request){

        Transactions::create($request->validated());

        return redirect('/home')->with('message', 'Uw transactie gegevens');


    }

}
