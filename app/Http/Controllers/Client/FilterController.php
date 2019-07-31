<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $query = Car::where('status', 'active');
        
        $orderBy = $request->orderBy;
        $sortBy = $request->sortBy;
        if(isset($orderBy) && isset($sortBy)){
            $query->orderBy($orderBy, $sortBy);
        }
        
        $carResults = $query->get();
        return view('client.car.filter-result', ['carResults' => $carResults]);
    }
}
