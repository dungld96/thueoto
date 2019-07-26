<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
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
                $eView = '<a title="Xem" data-id="'.$booking->id.'" class="btnViewTrip btn btn-xs btn-info"><i class="fas fa-eye"></i></a>';
                $eConfirm = '<a title="Hành động" data-id="'.$booking->id.'" class="btnActionTrip btn btn-xs btn-success"><i class="fas fa-edit"></i></a>';
                $eDelete = '<a title="Xóa" data-id="'.$booking->id.'" class="btnDeleteTrip btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                
                if($booking->bookingStatus < BookingDetail::STATUS_APPROVED){
                    $eConfirm = '';
                }

                if(!Auth::user()->isAdmin()){
                    $eDelete = '';
                }

                return $eView.$eConfirm.$eDelete;
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
                '<a data-id="'.$booking->id.'" class="btnApproveBooking btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Duyệt</a>
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
        return view('admin.booking._approve', 
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
            if($bookingDetail->status == BookingDetail::STATUS_PENDING){
                $bookingDetail->status = BookingDetail::STATUS_APPROVED;
                $bookingDetail->save();
            }else{
                return response()->json(['message'=>'Không thể xác nhận', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function cancelBooking($id)
    {
        try {
            $trip = BookingDetail::find($id);
            if($trip->status < BookingDetail::STATUS_START){
                $trip->status = BookingDetail::STATUS_AD_CANCEL;
                $trip->save();
            }else{
                return response()->json(['message'=>'Không thể hủy chuyến', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function startTrip($id)
    {
        try {
            $trip = BookingDetail::find($id);
            if($trip->status == BookingDetail::STATUS_APPROVED){
                $trip->status = BookingDetail::STATUS_START;
                $trip->save();
            }else{
                return response()->json(['message'=>'Không thể chuyển sang trạng thái giao xe', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xác nhận chuyến xe đã được thuê thành công', 'status' => 'success']);
    }

    public function endTrip($id)
    {
        try {
            $trip = BookingDetail::find($id);
            if($trip->status == BookingDetail::STATUS_START || $trip->status == BookingDetail::STATUS_PENDING_END){
                $trip->status = BookingDetail::STATUS_END;
                $trip->save();
            }else{
                return response()->json(['message'=>'Không thể chuyển sang trạng thái trả xe', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Kết thúc chuyến xe thành công', 'status' => 'success']);
    }
    
    public function view($id)
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
        return view('admin.trips._view', 
            [
                'bookingDetail' => $bookingDetail, 
                'customer' => $customer, 
                'car' => $car,
                'diffDays' => $diffDays,
                'sumAmount' => $sumAmount
            ]);
    }

    public function tripAction($id)
    {
        $trip = BookingDetail::find($id);
        return view('admin.trips._action', ['trip' => $trip]);
    }

    public function deleteTrip($id)
    {
        try {
            $trip = BookingDetail::find($id);
            if($trip->status != BookingDetail::STATUS_START && $trip->status != BookingDetail::STATUS_PENDING_END){
                $trip->delete();
            }else{
                return response()->json(['message'=>'Không thể xóa chuyến xe đang thuê và chưa xác nhận trả xe', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa chuyến xe thành công', 'status' => 'success']);
        
    }



}
