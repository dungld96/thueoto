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
    public function carDetail($slug)
    {
    	$car = Car::where('slug', $slug)->first();
    	$carSimilars = Car::all();
    	$carImages = CarImages::where('car_id', $car->id)->get();
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
			$dataBooking['sumAmount'] = $sumAmount;
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
	    	$booking->trip_code = $this->generateTripCode();
	    	$booking->booking_date = date('Y-m-d H:i:s');
	    	$booking->start_date = date('Y-m-d H:i:s', $request->start_date);
	    	$booking->end_date = date('Y-m-d H:i:s', $request->end_date);
	    	$booking->place_delivery = $request->address;	
	    	$booking->description = $request->description;	
	    	$booking->sum_amount = $request->sum_amount;	
	    	$booking->status = BookingDetail::STATUS_PENDING;

	    	$booking->save();
    	} catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
    		
    	}
    	return response()->json(['message'=>'Thành công', 'status' => 'success']);
    	
	}
	
	public function generateTripCode()
	{
		$str = "";
		$characters = array_merge(range('A','Z'),range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		$checkFound = BookingDetail::where('trip_code', $str);
		if ($checkFound->exists()) {
			$this->generateTripCode();
		}else{
			return $str;
		}
	}

	public function getMyTrips()
	{

		$myTrips = BookingDetail::join('cars', 'booking_details.car_id', '=', 'cars.id')
					->select(
						'cars.name as carName', 
						'cars.thumbnail as carThumbnail', 
						'booking_details.trip_code as tripCode', 
						'booking_details.start_date as startDate', 
						'booking_details.end_date as endDate', 
						'booking_details.booking_date as bookingDate', 
						'booking_details.status as bookingStatus', 
						'booking_details.sum_amount as sumAmount'
					)
					->where('booking_details.user_id', Auth::user()->id)
					->orderBy('booking_details.status', 'asc')
					->orderBy('booking_details.created_at', 'desc')
					->get();

		foreach ($myTrips as $trip) {
			$trip->startDate = Carbon::createFromFormat('Y-m-d H:i:s',$trip->startDate)->format('H:i - d/m/Y');
			$trip->endDate = Carbon::createFromFormat('Y-m-d H:i:s',$trip->endDate)->format('H:i - d/m/Y');
			$trip->bookingDate = Carbon::createFromFormat('Y-m-d H:i:s',$trip->bookingDate);
			$trip['tripTime'] = Carbon::today()->diffInDays($trip->bookingDate);
			$trip['tripStatus'] = BookingDetail::getStatus($trip->bookingStatus);
		}
		return view('client.trips.mytrips', ['myTrips'=> $myTrips]);
	}

	public function tripDetail($tripCode)
	{
		$trip = BookingDetail::join('cars', 'booking_details.car_id', '=', 'cars.id')
					->select(
						'cars.name as carName', 
						'cars.mortgage as carMortgage', 
						'cars.rules as carRules', 
						'cars.thumbnail as carThumbnail', 
						'cars.costs as carCosts', 
						'cars.slug as carSlug', 
						'booking_details.trip_code as tripCode', 
						'booking_details.start_date as startDate', 
						'booking_details.end_date as endDate', 
						'booking_details.place_delivery as bookingPlaceDelivery', 
						'booking_details.description as bookingDescription', 
						'booking_details.status as bookingStatus', 
						'booking_details.sum_amount as sumAmount'
					)
					->where('booking_details.trip_code', $tripCode)
					->first();
		$startDate =  Carbon::createFromFormat('Y-m-d H:i:s',$trip->startDate);
		$endDate = Carbon::createFromFormat('Y-m-d H:i:s',$trip->endDate);
		$trip->startDate = $startDate->format('H:i - d/m/Y');
		$trip->endDate = $endDate->format('H:i - d/m/Y');
		$trip['diffDays'] = $endDate->diffInDays($startDate);
		$trip['tripStatus'] = BookingDetail::getStatus($trip->bookingStatus);

		return view('client.trips.detail', ['trip'=> $trip]);
	}

	public function tripCancel($tripCode)
	{
		$trip = BookingDetail::where('trip_code', $tripCode)->firstOrFail();
		if(isset($trip->status) && $trip->status < BookingDetail::STATUS_APPROVED){
			$trip->status = BookingDetail::STATUS_CL_CANCEL;
			$trip->save();
		}
		return redirect()->route('user.mytrips');
	}

	public function tripReturn($tripCode)
	{
		$trip = BookingDetail::where('trip_code', $tripCode)->firstOrFail();
		if(isset($trip->status) && $trip->status == BookingDetail::STATUS_START){
			$trip->status = BookingDetail::STATUS_PENDING_END;
			$trip->save();
		}
		return redirect()->route('user.mytrips');
	}

}
