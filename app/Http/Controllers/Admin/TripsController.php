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

class TripsController extends Controller
{
    public function getTripsList()
    {
    	return view('admin.trips.index'); 
    }

    public function getTrips()
    {
        $booking = DB::table('booking_details')
            ->join('users', 'booking_details.user_id', '=', 'users.id')
    		->join('cars', 'booking_details.car_id', '=', 'cars.id')
            ->select(
                'booking_details.id as id',
                'users.name as name', 
                'users.phone_number as phone', 
                'cars.name as carName', 
                'booking_details.trip_code as tripCode', 
                'booking_details.start_date as startDate', 
                'booking_details.end_date as endDate', 
                'booking_details.booking_date as bookingDate',
                'booking_details.status as bookingStatus'
            )
            ->get();
    	return Datatables::of($booking)
            ->addColumn('action', function ($booking) {
                return 
                '<a title="Xem" data-id="'.$booking->id.'" class="btnActionBooking btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                <a title="Sửa" data-id="'.$booking->id.'" class="btnActionBooking btn btn-xs btn-success"><i class="fas fa-edit"></i></i></a>
                <a title="Xóa" data-id="'.$booking->id.'" class="btnCancelBooking btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
            })
            ->editColumn('startDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->startDate));
            })
            ->editColumn('endDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->endDate));
            })
            ->editColumn('bookingDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->bookingDate));
            })
            ->editColumn('bookingStatus', function ($booking) {
                return BookingDetail::getStatus($booking->bookingStatus);
            })
	        ->addIndexColumn()
            ->make();
    }

    public function booking(Request $request)
    {
    	return view('admin.booking.index');
    }

    public function getBooking()
    {
        $booking = DB::table('booking_details')
            ->join('users', 'booking_details.user_id', '=', 'users.id')
    		->join('cars', 'booking_details.car_id', '=', 'cars.id')
            ->select(
                'booking_details.id as id',
                'users.name as name', 
                'users.phone_number as phone', 
                'cars.name as carName', 
                'booking_details.trip_code as tripCode', 
                'booking_details.start_date as startDate', 
                'booking_details.end_date as endDate', 
                'booking_details.booking_date as bookingDate',
                'booking_details.status as bookingStatus'
            )
            ->where('booking_details.status' , '<',  BookingDetail::STATUS_APPROVED)
            ->get();

            
    	return Datatables::of($booking)
            ->addColumn('action', function ($booking) {
                return 
                '<a data-id="'.$booking->id.'" class="btnActionBooking btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Duyệt</a>
                <a data-id="'.$booking->id.'" class="btnCancelBooking btn btn-xs btn-danger"><i class="fa fa-times"></i> Hủy</a>';
            })
            ->editColumn('startDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->startDate));
            })
            ->editColumn('endDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->endDate));
            })
            ->editColumn('bookingDate', function ($booking) {
                return date('H:i - d/m/Y', strtotime($booking->bookingDate));
            })
            ->editColumn('bookingStatus', function ($booking) {
                return BookingDetail::getStatus($booking->bookingStatus);
            })
	        ->addIndexColumn()
            ->make();
    }
    

    public function approveBooking($id)
    {
        $bookingDetail = BookingDetail::find($id);
        $customer = User::find($bookingDetail->user_id);
        $car = Car::find($bookingDetail->car_id);
        $startDate = new Carbon($bookingDetail->start_date);
        $endDate = new Carbon($bookingDetail->end_date);
        $diffDays = $endDate->diff($startDate)->days + 1;
        $sumAmount = ($car->costs + 30) * $diffDays;
        $sumAmount = number_format($sumAmount, 0, ',', '.');
        $bookingDetail->start_date = date('H:i - d/m/Y', strtotime($bookingDetail->start_date));
        $bookingDetail->end_date = date('H:i - d/m/Y', strtotime($bookingDetail->end_date));
        $bookingDetail->booking_date = date('H:i - d/m/Y', strtotime($bookingDetail->booking_date));
        $bookingDetail['status_text'] = BookingDetail::getStatus($bookingDetail->status);
        return view('admin.booking._action', 
            [
                'bookingDetail' => $bookingDetail, 
                'customer' => $customer, 
                'car' => $car,
                'diffDays' => $diffDays,
                'sumAmount' => $sumAmount
            ]);
    }

    public function storeApprove($id)
    {
        try {
            $bookingDetail = BookingDetail::find($id);
            $bookingDetail->status = BookingDetail::STATUS_APPROVED;
            $bookingDetail->save();
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function cancelBooking($id)
    {
        try {
            $bookingDetail = BookingDetail::find($id);
            $bookingDetail->status = BookingDetail::STATUS_AD_CANCEL;
            $bookingDetail->save();
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }
}
