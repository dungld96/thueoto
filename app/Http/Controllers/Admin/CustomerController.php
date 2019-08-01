<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\BookingDetail;
use Carbon\Carbon;
use App\Models\Role;
use DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getCustomers()
    {
        $query = User::whereHas("roles", function($q){ 
            $q->where("role", 1); 
        })
        ->where('status', 'active')
        ->get();
            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                $eView = '<a title="Xem" data-id="'.$query->id.'" class="btnViewCustomer btn btn-xs btn-info"><i class="fas fa-eye"></i></a>';
                $eDelete = '<a title="Xóa" data-id="'.$query->id.'" class="btnDeleteCustomer btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                if(!Auth::user()->isAdmin()){
                    $eDelete = '';
                }
                return $eView.$eDelete;
                
            })
            ->editColumn('created_at', function ($query) {
                return date('d/m/Y', strtotime($query->created_at));
            })
	        ->addIndexColumn()
            ->make();
    }

    public function deleteCustomer($id)
    {
        $inTrip = BookingDetail::where('user_id', $id)->where('status', BookingDetail::STATUS_START);
        if(!$inTrip->exists()){
            try {
                $customer = User::findOrFail($id);
                $customer->status = 'delete';
                $customer->save();
                $allTripByCustomer = BookingDetail::where('user_id', $id)->get();
                foreach ($allTripByCustomer as $trip) {
                    $trip->status = BookingDetail::STATUS_AD_CANCEL;
                    $trip->save();
                }
            } catch (\Exception $e) {
                return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
            }
            return response()->json(['message'=>'Xóa khách hàng thành công', 'status' => 'success']);
        }else{
            return response()->json(['message'=>'Không thể xóa khách hàng đang thuê xe', 'status' => 'error']);
        }
    }

    public function viewCustomer($id)
    {
        $customer = User::findOrFail($id);
        $countTripSuccess = BookingDetail::where('user_id', $id)->where('status', BookingDetail::STATUS_END)->count();
        return view('admin.customers._view', ['customer' => $customer, 'countTripSuccess' => $countTripSuccess]);
    }

}
