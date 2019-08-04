<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\C_Make;
use Carbon\Carbon;
use Storage;
class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $query = Car::where('status', 'active');

        $startDate = Carbon::createFromTimestamp($request->startDate)->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromTimestamp($request->endDate)->format('Y-m-d H:i:s');
        if(isset($startDate) && isset($endDate)){
            $query->whereDoesntHave('booking_details', function ($q) use($startDate, $endDate){
                $q->where('start_date', '<=', $startDate)
                  ->where('end_date', '>=', $startDate)
                  ->orWhere(function ($qOr) use($endDate){
                    $qOr->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $endDate);
                    });
            });
        }

        $costsRange = $request->costsRange;        
        if(isset($costsRange)){
            $query->where('costs', '<', $costsRange);
        }

        $makeBy = $request->makeBy;        
        if(isset($makeBy)){
            $query->where('make_code', $makeBy);
        }

        $type = $request->type;        
        if(isset($type)){
            $query->where('seats', $type);
        }

        $orderBy = $request->orderBy;
        $sortBy = $request->sortBy;
        if(isset($orderBy) && isset($sortBy)){
            $query->orderBy($orderBy, $sortBy);
        }
        
        $carResults = $query->get();

        $makes = C_Make::all();
        $c_seats = json_decode(file_get_contents(storage_path().'/app/json/seats.json', false));
        return view('client.car.filter-result', ['carResults' => $carResults, 'makes' => $makes, 'c_seats' => $c_seats]);
    }
}
