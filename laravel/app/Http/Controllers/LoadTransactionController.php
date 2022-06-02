<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCustomer;
use Illuminate\Http\Request;

use App\Models\Transactions;
use App\Models\GovermentAdmin;
use App\Models\Customer;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // Function to load in the customers into the select option on the dashboard
    public function getCustomers(){

        $transactions = array();
        $customers = Customer::all();
        return view('dashboardcustomer', compact(['transactions', 'customers']));

    }

    // Function to load in the communities into the select option on the dashboard
    public function getGoverment(){

        $transactions = array();
        $communities = GovermentAdmin::all();
        return view('dashboardgoverment', compact(['transactions', 'communities']));

    }


    // Function to insert the customer ID into the SQL-code and send the results to the dashboard
    public function RecieveCustomerTransactions($customerID){

        $customers = Customer::all();
        $transactions = $this->indexcustomer($customerID);
        return view('dashboardcustomer', compact(['transactions', 'customers']));

    }

    // Function to insert the goverment ID into the SQL-code and send the results to the dashboard
    public function RecieveGovermentTransactions($govermentID){

        $communities = GovermentAdmin::all();
        $transactions = $this->indexgoverment($govermentID);
        return view('dashboardgoverment', compact(['transactions', 'communities']));

    }


        // TEST Function to insert a dynamic ID into the SQL-code and send the results to the dashboard TEST
        public function RecieveIDTransactions($ID){

            $role = 'customer';
            switch ($role) {
                case 'customer':
                    $customers = Customer::all();
                    $transactions = $this->indexcustomer($ID);
                    return view('dashboardcustomer', compact(['transactions', 'customers']));
                    break;
                case 'goverment':
                    $communities = GovermentAdmin::all();
                    $transactions = $this->indexgoverment($ID);
                    return view('dashboardgoverment', compact(['transactions', 'communities']));
                    break;
                default:
                    break;
            }
        }
        // TEST




    // Function to get all the transactions
    public function index(){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->get();

        return view('dashboard', compact(['transactions']));

    }

    // Function to get all the transactions from a specific customer
    public function indexcustomer($customerID){
        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('vmiddel', 'transacties.kenteken', '=', 'vmiddel.kenteken')
            ->join('klanten', 'vmiddel.ID_klant', '=', 'klanten.ID_klant')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->where('klanten.ID_klant', '=', $customerID)
            ->get();
            return $transactions;
    }

    // Function to get all the transactions from a specific goverment
    public function indexgoverment($govermentID){

        $transactions = Transactions::join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
            ->join('plaatsen', 'locaties.ID_plaats', '=', 'plaatsen.ID_plaats')
            ->join('gemeenten', 'plaatsen.ID_gemeente', '=', 'gemeenten.ID_gemeente')
            ->join('beheerders', 'gemeenten.ID_gemeente', '=', 'beheerders.ID_gemeente')
            ->join('provincies', 'gemeenten.ID_provincie', '=', 'provincies.ID_provincie')
            ->join('parkeerprijzen', 'locaties.ID_parkeerplaats', '=', 'parkeerprijzen.ID_parkeerplaats')
            ->where('beheerders.ID_beheerder', '=', $govermentID)
            ->get();
            return $transactions;

    }


}
