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
    		return response()->json(['message'=>'Thất bại', 'status' => 'error', 'error' => 'no-auth']);
    	}
    	if(!isset(Auth::user()->phone_number)){
			$notiHtml = view('client.app.notification')
						->with(['message' => 'Bạn cập nhật số điện thoại mới có thể đặt xe.', 'route' => 'user.account'])
						->render();
    		return response()->json(['html'=>$notiHtml, 'status' => 'error', 'error' => 'no-phone-number']);
    	}

    	try {
			$dataBooking = [];
			$id = $request->id;
			$car = Car::find($id);
			
			$startDate = Carbon::createFromTimestamp($request->start_date);
			$endDate = Carbon::createFromTimestamp($request->end_date);

			$bookedOfCar = BookingDetail::where('car_id',$id)->get();
			if($bookedOfCar){
				foreach ($bookedOfCar as $book) {
					$bookedStartDate = new Carbon($book['start_date']);
					$bookedEndDate = new Carbon($book['end_date']);
					if($startDate->between($bookedStartDate, $bookedEndDate) 
						|| $endDate->between($bookedStartDate, $bookedEndDate)){
						return response()->json(['message'=> 'Xe đã được đặt trong thời gian trên, vui lòng chọn lại thời gian', 'status' => 'error', 'error' => 'booked']);
					}

				}
			}

			$diffDays = $endDate->diff($startDate)->days + 1;
			$sumAmount = ($car->costs + 30) * $diffDays;
	    	$startDate = $startDate->format('H:i - d/m/Y');
			$endDate = $endDate->format('H:i - d/m/Y');
			
			$dataBooking['placeDelivery'] = $request->address;
			$dataBooking['startDateTt'] = $request->start_date;
			$dataBooking['endDateTt'] = $request->end_date;
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
	    	$booking->booking_date = date('Y-m-d H:i:s');
	    	$booking->start_date = date('Y-m-d H:i:s', $request->start_date);
	    	$booking->end_date = date('Y-m-d H:i:s', $request->end_date);
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
