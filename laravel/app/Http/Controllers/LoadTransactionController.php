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
use App\Models\Costumers;
//use Illuminate\Support\Facades\DB;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $transactions = Transactions::all();
        $vmiddel = vmiddel::all();
        $communities = Communities::all();
        $parkingprices = ParkingPrices::all();
        $places = Places::all();
        $provinces = Provinces::all();
        $location = Location::all();
        $customers = Costumers::all();
        // $test = DB::table('transacties')
        //    ->join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
        //    ->get();

        $transactieArray = json_decode($transactions);
        $locationArray = json_decode($location);
        $dataArray = array_merge($transactieArray, ['ID_parkeeplaats' => $locationArray]);
        $data = json_encode($dataArray);
        //$data = $transactions->merge($location);


        //return view('dashboard', compact(['transactions','vmiddel', 'communities', 'parkingprices', 'places', 'provinces', 'location', 'customers']));
        return view('dashboard', compact(['data']));

    }


}
