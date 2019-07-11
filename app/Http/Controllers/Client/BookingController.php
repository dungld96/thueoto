<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    		return response()->json(['message'=>'Thất bại', 'status' => 'no-auth', 'error' => 'no auth']);
    	}
    	try {
			$dataBooking = [];
			$car = Car::find($request->id);
			
			$startDate = date('Y-m-d', $request->start_date);
			$endDate = date('Y-m-d', $request->end_date);
			$startDate = Carbon::createFromFormat('Y-m-d', $startDate);
			$endDate = Carbon::createFromFormat('Y-m-d', $endDate);
			
			$diffDays = $endDate->diff($startDate)->days + 1;
			$sumAmount = ($car->costs + 30) * $diffDays;
	    	$startDate = date('h:i - d/m/Y', $request->start_date);
			$endDate = date('h:i - d/m/Y', $request->end_date);
			
			$dataBooking['placeDelivery'] = $request->address;
			$dataBooking['startDate'] = $startDate;
			$dataBooking['endDate'] = $endDate;
			$dataBooking['sumAmount'] = number_format($sumAmount, 0, ',', '.');
			$dataBooking['diffDays'] = $diffDays;
			$returnHTML = view('client.car.confirm-booking')->with(['car'=> $car, 'dataBooking' => $dataBooking])->render();

    	} catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
    	}
    	return response()->json(['message'=>'Thành công', 'status' => 'success', 'html' => $returnHTML]);
    	
	}
	
	public function confirmBooking(Request $request)
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
	    	$booking->description = $request->description;	
	    	$booking->status = 1;

	    	$booking->save();
    	} catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
    		
    	}
    	return response()->json(['message'=>'Thành công', 'status' => 'success']);
    	
	}
}
