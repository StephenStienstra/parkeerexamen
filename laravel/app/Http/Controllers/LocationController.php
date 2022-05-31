<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vmiddel;
use App\Models\Costumers;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $locations = Location::all();
        $numberboards = Vmiddel::all();
        $customers = Costumers::all();

        return view('home', compact(['customers', 'numberboards', 'locations']));

    }

    public function ajax(){

        $numberboards = Vmiddel::all();

        return response()->json([
            'numberboards' => $numberboards,
        ]);

    }

}
