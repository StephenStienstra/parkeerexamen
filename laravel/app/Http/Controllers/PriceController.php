<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\ParkingPrices;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PriceController extends Controller
{
    public function index()
    {

        $transactions = Transactions::all();
        $parkingplaceinfo = ParkingPrices::all();

        $prices = $this->CalculateDate($transactions);

        return view('pricecalculation', compact(['prices', 'transactions', 'parkingplaceinfo']));

    }

    public function CalculateDate($transactions)
    {

        $counter = 0;
        $basepriceperminute = 0.5;

        $past = Carbon::create('1970-01-01')->toDateTime();

        $prices = array();

        foreach($transactions as $key => $value){

            $records = DB::table('parkeerprijzen')->where('ID_Parkeerplaats', $transactions[$counter]->ID_Parkeerplaats)
            ->whereBetween('ingangsdatum', [$past, $transactions[$counter]->begintijd])
            ->orderBy('ingangsdatum', 'DESC')->get();

            $timeone = strtotime($transactions[$counter]->eindtijd);
            $timetwo = strtotime($transactions[$counter]->begintijd);

            $timespan = ($timeone - $timetwo) / 60;

            if($records->isEmpty()){

                $finalprice = round($timespan * $basepriceperminute, 2);

                $buildarray = array(
                    'ID_Parkeerplaats' => $transactions[$counter]->ID_Parkeerplaats,
                    'kenteken' => $transactions[$counter]->kenteken,
                    'begintijd' => $transactions[$counter]->begintijd,
                    'eindtijd' => $transactions[$counter]->eindtijd,
                    'kostenperminuut' => $basepriceperminute,
                    'prijs' => $finalprice,
                );

            }else{

                $finalprice = round($timespan * $records[0]->prijs);

                $buildarray = array(
                    'ID_Parkeerplaats' => $transactions[$counter]->ID_Parkeerplaats,
                    'kenteken' => $transactions[$counter]->kenteken,
                    'begintijd' => $transactions[$counter]->begintijd,
                    'eindtijd' => $transactions[$counter]->eindtijd,
                    'kostenperminuut' => $records[0]->prijs,
                    'prijs' => $finalprice,
                );

            }

            array_push($prices, $buildarray);

            $counter++;

        }

        return $prices;

    }
}
