<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSession;

use Illuminate\Http\Request;

class ParkingController extends Controller
{

    public function HandleReservation(ParkingSession $request){
dd($request);
        return view('home');

    }

}
