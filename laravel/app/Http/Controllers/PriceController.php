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

            $records = $this->GetDatabaseInfo($transactions, $counter, $past);
            $timespan = $this->GetTimeSpan($transactions, $counter);
            $priceperminute = $this->GetPricePerMinute($records, $basepriceperminute);

            $finalprice = round($timespan * $priceperminute, 2);
            $buildarray = $this->BuildArray($transactions, $counter, $priceperminute, $finalprice);

            array_push($prices, $buildarray);
            $counter++;

        }

        return $prices;

    }

    public function GetDatabaseInfo($transactions, $counter, $past)
    {

        return DB::table('parkeerprijzen')->where('ID_Parkeerplaats', $transactions[$counter]->ID_Parkeerplaats)
        ->whereBetween('ingangsdatum', [$past, $transactions[$counter]->begintijd])
        ->orderBy('ingangsdatum', 'DESC')->get();

    }

    public function GetTimeSpan($transactions, $counter)
    {
        if(strtotime($transactions[$counter]->eindtijd) == NULL){
            $transactions[$counter]->eindtijd = 'Transactie lopend: '.Carbon::now();
            return (strtotime(Carbon::now()) - strtotime($transactions[$counter]->begintijd)) / 60;
        }else{
            return (strtotime($transactions[$counter]->eindtijd) - strtotime($transactions[$counter]->begintijd)) / 60;
        }

    }

    public function GetPricePerMinute($records, $basepriceperminute)
    {

        if($records->isEmpty()){
            return $basepriceperminute;
        }else{
            return $records[0]->prijs;
        }

    }

    public function BuildArray($transactions, $counter, $priceperminute, $finalprice)
    {
        return array(
            'ID_Parkeerplaats' => $transactions[$counter]->ID_Parkeerplaats,
            'kenteken' => $transactions[$counter]->kenteken,
            'begintijd' => $transactions[$counter]->begintijd,
            'eindtijd' => $transactions[$counter]->eindtijd,
            'kostenperminuut' => $priceperminute,
            'prijs' => $finalprice,
        );
    }

}
