<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vmiddel;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $locations = Location::all();
        $numberboard = Vmiddel::all();

        return view('home', compact(['locations']), compact(['numberboard']));

    }
}
