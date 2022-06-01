<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Transactions;
use App\Models\Communities;
use App\Models\Customer;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function RecieveCustomerID(Request $request){

        $klantID = $request;
        return view('dashboardcustomer', compact(['klantID']));

    }


    public function index(){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->where('transacties.ID_parkeerplaats', '=', '1015')
            ->orderBy('klantnaam')
            ->get();

        return view('dashboard', compact(['transactions','CustomerID']));

    }

    // Functie om de transactiegegevens van een klant in te laden
    public function indexcustomer(){


        $klantID = 2010;
        //$klantID->RecieveCustomerID();

        $customers = Customer::all();
        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->orderBy('klantnaam')
            //->where('klanten.ID_klant', '=', $klantID)
            ->get();

        return view('dashboardcustomer', compact(['transactions', 'customers']));

    }

    // Functie om de transactiegegevens van een gemeente in te laden
    public function indexgoverment(){

        $communities = Communities::all();
        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('beheerders', 'gemeenten.ID_gemeente', '=', 'beheerders.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->get();

        return view('dashboardgoverment', compact(['transactions']));

    }


}
