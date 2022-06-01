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

        //Start calculation of price by giving the transaction database

        $prices = $this->CalculateDate($transactions);

        return view('pricecalculation', compact(['prices', 'transactions', 'parkingplaceinfo']));

    }

    public function CalculateDate($transactions)
    {

        //Declare variables

        $counter = 0;
        $basepriceperminute = 0.5;
        $past = Carbon::create('1970-01-01')->toDateTime();
        $prices = array();

        foreach($transactions as $key => $value){

            //Call needed functions

            $records = $this->GetDatabaseInfo($transactions, $counter, $past);
            $timespan = $this->GetTimeSpan($transactions, $counter);


            if($records->isEmpty()){

                //If there is no record, calculate price using the base price

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

                //If there is a record, calculate price using record price

                $finalprice = round($timespan * $records[0]->prijs, 2);

                $buildarray = array(
                    'ID_Parkeerplaats' => $transactions[$counter]->ID_Parkeerplaats,
                    'kenteken' => $transactions[$counter]->kenteken,
                    'begintijd' => $transactions[$counter]->begintijd,
                    'eindtijd' => $transactions[$counter]->eindtijd,
                    'kostenperminuut' => $records[0]->prijs,
                    'prijs' => $finalprice,
                );

            }

            //Push into array and prepare for second loop

            array_push($prices, $buildarray);
            $counter++;

        }

        //Return array
        dd($prices);
        return $prices;

    }

    public function GetDatabaseInfo($transactions, $counter, $past)
    {
        //Get the records for different parking spots where the parking spot ID matches the transaction's parking spot ID
        //Only show those which were declared between 1970 and the date of the start of the parking transaction
        //Order in descending order which will put the most recent price change to the top, giving the price needed for the calculation

        return $records = DB::table('parkeerprijzen')->where('ID_Parkeerplaats', $transactions[$counter]->ID_Parkeerplaats)
        ->whereBetween('ingangsdatum', [$past, $transactions[$counter]->begintijd])
        ->orderBy('ingangsdatum', 'DESC')->get();

    }

    public function GetTimeSpan($transactions, $counter)
    {
        //Get the starting and end time of the transaction
        //Calculate the amount of minutes the transaction took

        $timeone = strtotime($transactions[$counter]->eindtijd);
        $timetwo = strtotime($transactions[$counter]->begintijd);

        return $timespan = ($timeone - $timetwo) / 60;

    }

}
