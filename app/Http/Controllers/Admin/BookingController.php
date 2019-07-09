<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
class BookingController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.booking.index');
    }

    public function getAll()
    {
    	$booking = BookingDetail::join('users', 'booking_details.user_id', '=', 'users.id')
    		->join('cars', 'booking_details.car_id', '=', 'cars.id')
            ->select(['booking_details.id as id','users.name as name', 'users.phone_number as phone', 'cars.name as carName', 'booking_details.start_date as startDate', 'booking_details.end_date as endDate', 'booking_details.booking_date as bookingDate'])
            ->get();
    	return Datatables::of($booking)
            ->addColumn('action', function ($cars) {
	            return '<a data-id="#" class="btnEditCar btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Xem</a>';
	        })
	        ->addIndexColumn()
            ->make();
    }
}
