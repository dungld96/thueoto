<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $params = $request->all();
        $carResults = Car::where('status', 'active')->get();
        return view('client.car.filter-result', ['carResults' => $carResults]);
    }
}
