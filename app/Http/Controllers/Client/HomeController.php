<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\C_Config;

class HomeController extends Controller
{
    public function index()
    {
        $topCars = Car::where('is_top', 'T')
            ->where('status', 'active')
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        $saleCars = Car::whereNotNull('promotion_costs')
            ->where('promotion_costs', '<>', '')
            ->where('status', 'active')
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        $newCars = Car::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        $infoSystemCf = C_Config::getInfoSystemCf();

    	return view('client.welcome', ['topCars' => $topCars, 'newCars' => $newCars, 'saleCars' => $saleCars, 'infoSystemCf' => $infoSystemCf]);
    }
}
