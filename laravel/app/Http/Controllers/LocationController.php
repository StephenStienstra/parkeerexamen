<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vmiddel;
use App\Models\Klanten;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $locations = Location::all();
        $numberboards = Vmiddel::all();
        $customers = Klanten::all();


        return view('home', compact(['customers', 'numberboards', 'locations']));

    }
}
