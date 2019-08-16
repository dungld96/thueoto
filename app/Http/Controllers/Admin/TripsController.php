<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Car;
use App\Models\C_Config;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;

class TripsController extends Controller
{
    public function getTripsList()
    {
    	return view('admin.trips.index'); 
    }

    public function getTrips(Request $request)
    {
        $inpStatusParams = $request->status_filter_params;
        $status=[];
        if (is_array($inpStatusParams) || is_object($inpStatusParams))
        {
            foreach ($inpStatusParams as $param) {
                $status[] = $param['value'];
            }
        }
        
        $query = DB::table('booking_details')
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
            );

        if(count($status) > 0){
            $query->whereIn('booking_details.status', $status);
        }

        $query->orderBy('booking_details.updated_at', 'desc');
        $query->orderBy('booking_details.created_at', 'desc');

        $query =  $query->get();

    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                $eView = '<a title="Xem" data-id="'.$query->id.'" class="btnViewTrip btn btn-xs btn-info"><i class="fas fa-eye"></i></a>';
                $eConfirm = '<a title="Hành động" data-id="'.$query->id.'" class="btnActionTrip btn btn-xs btn-success"><i class="fas fa-edit"></i></a>';
                $eDelete = '<a title="Xóa" data-id="'.$query->id.'" class="btnDeleteTrip btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                
                if($query->bookingStatus < BookingDetail::STATUS_APPROVED){
                    $eConfirm = '';
                }

                if(!Auth::user()->isAdmin()){
                    $eDelete = '';
                }

                return $eView.$eConfirm.$eDelete;
            })
            ->editColumn('startDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->startDate));
            })
            ->editColumn('endDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->endDate));
            })
            ->editColumn('bookingDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->bookingDate));
            })
            ->editColumn('bookingStatus', function ($query) {
                return BookingDetail::getStatus($query->bookingStatus);
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
        $query = DB::table('booking_details')
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
            ->orderBy('booking_details.updated_at', 'desc')
            ->orderBy('booking_details.created_at', 'desc')
            ->get();

            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                return 
                '<a data-id="'.$query->id.'" class="btnApproveBooking btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Duyệt</a>
                <a data-id="'.$query->id.'" class="btnCancelBooking btn btn-xs btn-danger"><i class="fa fa-times"></i> Hủy</a>';
            })
            ->editColumn('startDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->startDate));
            })
            ->editColumn('endDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->endDate));
            })
            ->editColumn('bookingDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->bookingDate));
            })
            ->editColumn('bookingStatus', function ($query) {
                return BookingDetail::getStatus($query->bookingStatus);
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
            ]);
    }

    public function storeApproveBooking($id)
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
        $sendSms = $this->sendSms($bookingDetail);
        return response()->json(['message'=>'Thành công', 'smsMessage' => $sendSms, 'status' => 'success']);
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
                return response()->json(['message'=>'Thất bại, chuyến xe phải đang ở trạng thái đã xác nhận đặt xe', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xác nhận khách đã nhận xe và chuyến xe đã được thuê thành công', 'status' => 'success']);
    }

    public function endTrip($id)
    {
        try {
            $trip = BookingDetail::find($id);
            if($trip->status == BookingDetail::STATUS_START || $trip->status == BookingDetail::STATUS_PENDING_END){
                $trip->status = BookingDetail::STATUS_END;
                $trip->save();
            }else{
                return response()->json(['message'=>'Thất bại, chuyến xe phải đang ở trạng thái nhận xe hoặc chờ xác nhận trả xe', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xác nhận khách trả xe và kết thúc chuyến xe thành công', 'status' => 'success']);
    }
    
    public function view($id)
    {
        $bookingDetail = BookingDetail::find($id);
        $customer = User::find($bookingDetail->user_id);
        $car = Car::find($bookingDetail->car_id);
        $startDate = new Carbon($bookingDetail->start_date);
        $endDate = new Carbon($bookingDetail->end_date);
        $diffDays = $endDate->diff($startDate)->days + 1;
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


    public function return(Request $request)
    {
    	return view('admin.return.index');
    }

    public function getReturn()
    {
        $query = DB::table('booking_details')
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
            ->where('booking_details.status' ,  BookingDetail::STATUS_PENDING_END)
            ->get();

            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                return 
                '<a title="Xem" data-id="'.$query->id.'" class="btnViewTrip btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                <a title="Xác nhận" data-id="'.$query->id.'" class="btnConfirmReturn btn btn-xs btn-success"><i class="fas fa-edit"></i></a>';
            })
            ->editColumn('startDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->startDate));
            })
            ->editColumn('endDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->endDate));
            })
            ->editColumn('bookingDate', function ($query) {
                return date('H:i - d/m/Y', strtotime($query->bookingDate));
            })
            ->editColumn('bookingStatus', function ($query) {
                return BookingDetail::getStatus($query->bookingStatus);
            })
	        ->addIndexColumn()
            ->make();
    }

    public function sendSms($trip)
    {
        $user = User::find($trip->user_id);
        $car = Car::find($trip->car_id);
        $esmsKeyCf = C_Config::getEsmsKeyCf();	
        $start = date('d/m/Y', strtotime($trip->start_date));
        $end = date('d/m/Y', strtotime($trip->end_date));

        $content = 'Ban da dat xe thanh cong tai VinhTinAuto: xe '.$car->name.', thoi gian thue tu ngay: '.$start.' den '.$end.', ma dat xe: '.$trip->trip_code
                    .'. Hotline: 0868698682. Cam on ban da su dung dich vu.';
        $client = new Client();
        $res = $client->get(
            'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone='.$user->phone_number
            .'&Content='.$content.'&ApiKey='.$esmsKeyCf->api_key.'&SecretKey='.$esmsKeyCf->secret_key.'&SmsType=4'
        );
        if($res->getStatusCode() == 200){
            $data = json_decode($res->getBody()->getContents());
            if($data->CodeResult == 100){
                return 'Request gửi tin nhắn thành công';
            }

            if($data->CodeResult == 102){
                return 'Tài khoản bị khóa';
            }
            
            if($data->CodeResult == 103){
                return 'Số dư tài khoản không đủ để gửi tin nhắn';
            }
        }else{
            return 'Gửi tin nhắn thất bại';
        }
    }

}