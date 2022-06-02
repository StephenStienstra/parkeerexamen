<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCustomer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Transactions;
use App\Models\GovermentAdmin;
use App\Models\Customer;
use App\Models\ParkingPrices;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Function to load in the customers into the select option on the dashboard
    public function GetCustomers(){

        $transactions = array();
        $customers = Customer::all();
        return view('dashboardcustomer', compact(['transactions', 'customers']));

    }

    // Function to load in the communities into the select option on the dashboard
    public function GetGoverment(){

        $transactions = array();
        $communities = GovermentAdmin::all();
        return view('dashboardgoverment', compact(['transactions', 'communities']));

    }


    // Function to insert the customer ID into the SQL-code and send the results to the dashboard
    public function RecieveCustomerTransactions($customerID){

        $customers = Customer::all();
        $transactions = $this->databasecustomer($customerID);
        $prices = $this->CalculateDate($transactions);
        return view('dashboardcustomer', compact(['transactions', 'customers', 'prices']));

    }

    // Function to insert the goverment ID into the SQL-code and send the results to the dashboard
    public function RecieveGovermentTransactions($govermentID){

        $communities = GovermentAdmin::all();
        $transactions = $this->DatabaseGoverment($govermentID);
        $prices = $this->CalculateDate($transactions);
        return view('dashboardgoverment', compact(['transactions', 'communities', 'prices']));

    }

    // Function to get all the transactions
    public function GetAllTransactions(){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->where('provincies.provincienaam', '=', 'Overijssel')
            ->get();

        $prices = $this->CalculateDate($transactions);

        return view('dashboard', compact(['transactions', 'prices']));

    }

    // Function to get all the transactions from a specific customer
    public function DatabaseCustomer($customerID){
        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->where('klanten.ID_klant', '=', $customerID)
            ->get();
            return $transactions;
    }

    // Function to get all the transactions from a specific goverment
    public function DatabaseGoverment($govermentID){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('beheerders', 'gemeenten.ID_gemeente', '=', 'beheerders.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->where('beheerders.ID_beheerder', '=', $govermentID)
            ->get();
            return $transactions;

    }





    // Functions for the Price, see PriceController.php for explanation
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
    // PriceController Functions

}



