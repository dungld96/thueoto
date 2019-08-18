<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\C_Config;
use App\Models\Coupon;

class BookingController extends Controller
{
    public function carDetail($slug)
    {
		$car = Car::where('slug', $slug)->first();
        $carFunction = json_decode($car->function);
		$serviceCosts = C_Config::getServiceCosts();
		$infoSystemCf = C_Config::getInfoSystemCf();			
    	$carSimilars = Car::where('status', 'active')->get();
    	$carImages = CarImages::where('car_id', $car->id)->get();
    	return view('client.car.booking-detail', [
				'car' => $car, 
				'carSimilars' => $carSimilars, 
				'carImages' => $carImages, 
				'serviceCosts' => $serviceCosts, 
				'infoSystemCf' => $infoSystemCf,
				'carFunction' => $carFunction
		]);
    }

    public function booking(Request $request)
    {
		  $serviceCosts = C_Config::getServiceCosts();

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

				if(isset($car->promotion_costs) && isset($request->coupon_code)){
					return response()->json(['message'=>'Không thể dùng mã khuyến mãi cho xe đang giảm giá', 'status' => 'error', 'error' => 'has_promo']);
				}

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
				if(isset($car->promotion_costs)){
					$sumAmount = ($car->promotion_costs + $serviceCosts) * $diffDays;
				}else{
					$sumAmount = ($car->costs + $serviceCosts) * $diffDays;
				}
				$startDate = $startDate->format('H:i - d/m/Y');
				$endDate = $endDate->format('H:i - d/m/Y');
				
				$dataBooking['placeDelivery'] = $request->address;
				$dataBooking['startDateTt'] = $request->start_date;
				$dataBooking['endDateTt'] = $request->end_date;
				$dataBooking['startDate'] = $startDate;
				$dataBooking['endDate'] = $endDate;
				$dataBooking['sumAmount'] = $sumAmount;
				$dataBooking['diffDays'] = $diffDays;
				$dataBooking['serviceCosts'] = C_Config::getServiceCosts();

				if(isset($request->coupon_code)){
					$dataBooking['coupon_code'] = $request->coupon_code;
					$coupon = Coupon::where('code', $request->coupon_code)->firstOrFail();
					$discount = ($sumAmount*$coupon->discount_amount)/100;
					if(isset($coupon->max_discount) && $discount >= $coupon->max_discount){
						$discount = $coupon->max_discount;
						$dataBooking['sumAmount'] = $dataBooking['sumAmount'] - $discount;
					}
					$dataBooking['coupon_discount'] = $discount;

				}


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

			if(isset($request->promotion_costs) && isset($request->coupon_code)){
				return response()->json(['message'=>'Không thể dùng mã khuyến mãi cho xe đang giảm giá', 'status' => 'error']);
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
	    	$booking->costs = $request->costs;	
	    	$booking->promotion_costs = $request->promotion_costs;
	    	$booking->service_costs = $request->service_costs;
	    	$booking->coupon_code = $request->coupon_code;
	    	$booking->coupon_discount = $request->coupon_discount;
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
						'booking_details.service_costs as serviceCosts',
						'booking_details.promotion_costs as promotionCosts',
						'booking_details.coupon_code as couponCode',
						'booking_details.coupon_discount as couponDiscount',
						'booking_details.sum_amount as sumAmount'
					)
					->where('booking_details.trip_code', $tripCode)
					->first();
		$startDate =  Carbon::createFromFormat('Y-m-d H:i:s',$trip->startDate);
		$endDate = Carbon::createFromFormat('Y-m-d H:i:s',$trip->endDate);
		$trip->startDate = $startDate->format('H:i - d/m/Y');
		$trip->endDate = $endDate->format('H:i - d/m/Y');
		$trip['diffDays'] = $endDate->diffInDays($startDate)+1;
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

	public function getMyCoupons()
	{
		$now = date('Y-m-d'); 
		$myCoupons = Coupon::where('status', 'active')
							->whereDate('starts_at', '<=',  $now)
							->whereDate('expires_at', '>=',  $now)
							->get();
		foreach ($myCoupons as $myCoupon) {
			$myCoupon->starts_at = Carbon::createFromFormat('Y-m-d', $myCoupon->starts_at)->format('d/m/Y');
			$myCoupon->expires_at = Carbon::createFromFormat('Y-m-d', $myCoupon->expires_at)->format('d/m/Y');
		}
		return view('client.car._coupon', ['myCoupons' => $myCoupons]);
	}

	public function checkCoupon($id)
	{
		$now = date('Y-m-d'); 
		try {
			$coupon = Coupon::where('id', $id)
			->where('status', 'active')
			->whereDate('starts_at', '<=',  $now)
			->whereDate('expires_at', '>=',  $now)
			->firstOrFail();

			return response()->json(['message'=>'Thành công', 'status' => 'success', 'coupon' => $coupon]);
		} catch (\Exception $e) {
			return response()->json(['message'=>'Bạn không thể sử dụng mã này', 'status' => 'error']);
		}

	}

	public function searchCoupon(Request $request)
	{
		$key = $request->key;
		$now = date('Y-m-d'); 
		try {
			$myCoupons = Coupon::where('status', 'active')
				->whereDate('starts_at', '<=',  $now)
				->whereDate('expires_at', '>=',  $now);
				

			if(!empty($key)){
				$myCoupons->where('code', $key);
			}

			$myCoupons = $myCoupons->get();
			
			foreach ($myCoupons as $myCoupon) {
				$myCoupon->starts_at = Carbon::createFromFormat('Y-m-d', $myCoupon->starts_at)->format('d/m/Y');
				$myCoupon->expires_at = Carbon::createFromFormat('Y-m-d', $myCoupon->expires_at)->format('d/m/Y');
			}
			

			return response()->json(['message'=>'Thành công', 'status' => 'success', 'coupon' => $myCoupons]);
		} catch (\Exception $e) {
			return response()->json(['message'=>'Mã khuyến mãi không tồn tại', 'status' => 'error']);
		}
		
	}


    public function viewCarSpec($id)
    {
		$car = Car::find($id);
        return view('client.car.car-spec', ['car' => $car]);
    }






}
