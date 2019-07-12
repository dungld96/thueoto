<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Car;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.booking.index');
    }

    public function getAll()
    {
        $booking = DB::table('booking_details')
            ->join('users', 'booking_details.user_id', '=', 'users.id')
    		->join('cars', 'booking_details.car_id', '=', 'cars.id')
            ->select('booking_details.id as id','users.name as name', 'users.phone_number as phone', 'cars.name as carName', 'booking_details.start_date as startDate', 'booking_details.end_date as endDate', 'booking_details.booking_date as bookingDate')
            ->get();

            
    	return Datatables::of($booking)
            ->addColumn('action', function ($booking) {
	            return '<a data-id="'.$booking->id.'" class="btnViewBooking btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Xem</a>';
	        })
	        ->addIndexColumn()
            ->make();
    }
    

    public function view($id)
    {
        $bookingDetail = BookingDetail::find($id);
        $customer = User::find($bookingDetail->user_id);
        $car = Car::find($bookingDetail->car_id);
        $bookingDetail->start_date = date('h:i - d/m/Y', strtotime($bookingDetail->start_date));
        $bookingDetail->end_date = date('h:i - d/m/Y', strtotime($bookingDetail->end_date));
        $bookingDetail->booking_date = date('h:i - d/m/Y', strtotime($bookingDetail->booking_date));
        // $startDate = new Carbon($bookingDetail->start_date);
		// $endDate = new Carbon($bookingDetail->end_date);
        // $diffDays = $endDate->diff($startDate)->days + 1;
		// $sumAmount = ($car->costs + 30) * $diffDays;
        return view('admin.booking._view', ['bookingDetail' => $bookingDetail, 'customer' => $customer, 'car' => $car]);
    }
}
