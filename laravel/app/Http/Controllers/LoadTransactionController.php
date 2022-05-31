<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transactions;
use App\Models\Vmiddel;
use App\Models\Communities;
use App\Models\ParkingPrices;
use App\Models\Places;
use App\Models\Provinces;
use App\Models\Location;
use App\Models\Customer;
//use Illuminate\Support\Facades\DB;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
           ->get();

        return view('dashboard', compact(['transactions']));

    }


}
