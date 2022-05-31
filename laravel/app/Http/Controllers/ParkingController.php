<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingController extends Controller
{

    public function HandleReservation(ParkingSession $request){

        return redirect('/home')->with('message', 'Uw transactie gegevens');

    }

}
