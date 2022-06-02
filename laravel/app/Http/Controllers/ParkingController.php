<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSession;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParkingController extends Controller
{

    public function HandleReservation(ParkingSession $request){

        if(isset($request['eindtijd'])){
            if(isset($request['start'])){
                return redirect('/home')->with('message', 'Eindig eerst uw huidige sessie');
            }


                $sql = "UPDATE transacties SET eindtijd = CURRENT_TIMESTAMP() WHERE kenteken = ? AND isnull(eindtijd)";
                DB::update($sql, [$request['kenteken']]);
                return redirect('/home')->with('message', 'transactie is gestopt');


            // ]);
        }

        Transactions::create($request->validated());
        return redirect('/home')->with('message', 'Uw transactie gegevens');

    }
}
