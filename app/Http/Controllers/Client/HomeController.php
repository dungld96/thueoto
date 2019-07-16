<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
    	$cars = Car::all();
    	$newCars = Car::orderBy('created_at', 'desc')->get();
    	return view('client.welcome', ['cars' => $cars, 'newCars' => $newCars]);
    }
}
