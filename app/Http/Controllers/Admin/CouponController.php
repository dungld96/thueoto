<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use DataTables;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index() {
        return view('admin.coupons.index');
    }

    public function getCoupons()
    {
        $query = Coupon::all();
            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                $eView = '<a title="Sửa" data-id="'.$query->id.'" class="btnEditCoupon btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
                $eDelete = '<a title="Xóa" data-id="'.$query->id.'" class="btnDeleteCoupon btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                return $eView.$eDelete;
                
            })
            ->editColumn('starts_at', function ($query) {
                return date('d/m/Y', strtotime($query->starts_at));
            })
            ->editColumn('expires_at', function ($query) {
                return date('d/m/Y', strtotime($query->expires_at));
            })
            ->editColumn('status', function ($query) {
                return $query->status == 'active' ? 'Hoạt động' : 'Không hoạt động';
            })
	        ->addIndexColumn()
            ->make();
    }

    public function create()
    {
        $coupon = new Coupon();
        return view('admin.coupons._edit', ['coupon' => $coupon]);
    }

    public function store(Request $request)
    {
        try {
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->max_discount = $request->max_discount;
            $coupon->starts_at = Carbon::createFromFormat('d/m/Y',$request->starts_at)->format('Y-m-d');;
            $coupon->expires_at = Carbon::createFromFormat('d/m/Y',$request->expires_at)->format('Y-m-d');
            $coupon->status = $request->status;
            $coupon->save();

            return response()->json(['message'=>'Thêm mã giảm giá thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $coupon->starts_at = Carbon::createFromFormat('Y-m-d',$coupon->starts_at)->format('d/m/Y');;
        $coupon->expires_at = Carbon::createFromFormat('Y-m-d',$coupon->expires_at)->format('d/m/Y');
        return view('admin.coupons._edit', ['coupon' => $coupon]);
    }

    public function update(Request $request){
        try {
            $coupon = Coupon::find($request->id);
            $coupon->code = $request->code;
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->max_discount = $request->max_discount;
            $coupon->starts_at = Carbon::createFromFormat('d/m/Y',$request->starts_at)->format('Y-m-d');;
            $coupon->expires_at = Carbon::createFromFormat('d/m/Y',$request->expires_at)->format('Y-m-d');
            $coupon->status = $request->status;
            $coupon->save();

            return response()->json(['message'=>'Update mã giảm giá thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
    }

    public function delete($id)
    {
        try {
            Coupon::find($id)->delete();;
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa mã khuyến mãi thành công', 'status' => 'success']);
    }

}
