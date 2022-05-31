<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vmiddel;
use App\Models\Customer;
use App\Models\Transactions;

class LocationController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $locations = Location::all();
        $numberboards = Vmiddel::all();
        $customers = Customer::all();
        $transactions = Transactions::all();

        return view('home', compact(['customers', 'numberboards', 'locations']));

    }

    public function endsession(){

        $transactions = Transactions::all();

        return response()->json([
            'transactions' => $transactions,
        ]);

    }
    public function fetchnumberboards(){

        $numberboards = Vmiddel::all();

        return response()->json([
            'numberboards' => $numberboards,
        ]);

    }

}
