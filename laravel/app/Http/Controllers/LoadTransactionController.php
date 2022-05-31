<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\DB;

class LoadTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $transactions = Transactions::all();
        // $test = DB::table('transacties')
        //    ->join('locaties', 'transacties.ID_Parkeerplaats', '=', 'locaties.ID_Parkeerplaats')
        //    ->get();


        return view('dashboard', compact(['transactions']));

    }


}
