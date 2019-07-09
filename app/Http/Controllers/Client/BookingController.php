<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Auth;
use DateTime;
class BookingController extends Controller
{
    public function getDetail($id)
    {
    	$car = Car::find($id);
    	$carSimilars = Car::all();
    	$carImages = CarImages::where('car_id', $id)->get();
    	return view('client.car.booking-detail', ['car' => $car, 'carSimilars' => $carSimilars, 'carImages' => $carImages]);
    }

    public function booking(Request $request)
    {
    	if(Auth::guest()){
    		return response()->json(['message'=>'Thất bại', 'status' => 'login', 'error' => 'auth']);
    	}

    	try {
    		$booking = new BookingDetail();
	    	$booking->user_id = Auth::user()->id;
	    	$booking->car_id = $request->id;
	    	$booking->booking_date = date('Y-m-d h:i:s');
	    	$booking->start_date = date('Y-m-d h:i:s', $request->start_date);
	    	$booking->end_date = date('Y-m-d h:i:s', $request->end_date);
	    	$booking->place_delivery = $request->address;	
	    	$booking->status = 1;

	    	$booking->save();
    	} catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
    		
    	}
    	return response()->json(['message'=>'Thành công', 'status' => 'success']);
    	
    }
}
