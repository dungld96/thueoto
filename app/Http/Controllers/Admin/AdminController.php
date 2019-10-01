<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\C_Config;
use DataTables;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function notifications()
    {
        try {
            $notifications = auth()->user()->notifications()->orderBy('created_at')->limit(15)->get()->toArray();
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success', 'data' => $notifications]);
    }

    public function readNotifications($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id)->first();
      
        if($notification != null){
            $notification->markAsRead();
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
        }
        return response()->json(['message'=> 'Not read', 'status' => 'error']);
    }

    public function getUsers()
    {
        $query = User::whereHas("roles", function($q){ 
            $q->where("role", 2); 
        })
        ->where('status', 'active')
        ->orderBy('updated_at', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();
        
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                $eView = '<a title="Xem" data-id="'.$query->id.'" class="btnEditUser btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></a>';
                $eDelete = '<a title="Xóa" data-id="'.$query->id.'" class="btnDeleteUser btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                
                return $eView.$eDelete;
                
            })
	        ->addIndexColumn()
            ->make();
    }

    public function changePassword()
    {
        return view('admin.users.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate(
            [
                'password' => 'required|string|min:6',
            ],
            [
                'password.required' => 'Mật khẩu không được để trống',
                'password.string' => 'Mật khẩu không hợp lệ',
                'password.min' => 'Mật khẩu phải dài hơn 6 ký tự'
            ]);

            try {
                $current_password = Auth::User()->password;
                if(password_verify($request->current_password, $current_password))
                {           
                    $userId = Auth::User()->id;                       
                    $user = User::find($userId);
                    $user->password = bcrypt($request->password);;
                    $user->save(); 
                }else{
                    return response()->json(['message'=> 'Mật khẩu hiện tại không đúng', 'status' => 'error']);
                }
            } catch (\Exception $e) {
                return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
            }
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function createMod()
    {
        $user = new User();
        return view('admin.users._edit', ['user' => $user]);
    }
    

    public function storeMod(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|regex:/^.+@.+$/',
            ],
            [
                'phone_number' => 'required|regex:/^[0-9]{9,15}$/',
            ],
            [
                'email.required' => 'Email không được để trống',
                'email.regex' => 'Email không hợp lệ'
            ],
            [
                'phone_number.required' => 'Số điện thoại không được để trống',
                'phone_number.regex' => 'Số điện thoại không hợp lệ'
            ]);
            DB::beginTransaction();
            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt('vinhtin123');
                $user->save();
                $user->roles()->attach(Role::where('role', 2)->first());
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                if($e->errorInfo[1] == 1062){
                    $message = 'Số điện thoại hoặc email đã tồn tại.';
                }else{
                    $message = $e->getMessage();
                }
                return response()->json(['message'=>$message, 'status' => 'error']);
            }
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function editMod($id)
    {
        $user = User::find($id);
        return view('admin.users._edit', ['user' => $user]);
    }

    public function updateMod(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|regex:/^.+@.+$/',
            ],
            [
                'phone_number' => 'required|regex:/^[0-9]{9,15}$/',
            ],
            [
                'email.required' => 'Email không được để trống',
                'email.regex' => 'Email không hợp lệ'
            ],
            [
                'phone_number.required' => 'Số điện thoại không được để trống',
                'phone_number.regex' => 'Số điện thoại không hợp lệ'
            ]);
        
            try {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt('vinhtin123');
                $user->save();
            } catch (\Exception $e) {
                if($e->errorInfo[1] == 1062){
                    $message = 'Số điện thoại hoặc email đã tồn tại.';
                }else{
                    $message = $e->getMessage();
                }
                return response()->json(['message'=>$message, 'status' => 'error']);
            }
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function deleteMod($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->delete();
            $user->roles()->detach();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa tài khoản thành công', 'status' => 'success']);
    }

    public function configs()
    {
        try {
            $infoSystemCf = C_Config::getInfoSystemCf();	
            $serviceCostsCf = C_Config::getServiceCosts();	
            $esmsKeyCf = C_Config::getEsmsKeyCf();	
        } catch (\Exception $e) {
            return $e->getMessage();
        }
       

        return view('admin.configs.index', [
            'infoSystemCf' => $infoSystemCf, 
            'serviceCostsCf' => $serviceCostsCf,
            'esmsKeyCf' => $esmsKeyCf 
        ]);
    }

    public function updateConfigs(Request $request)
    {
        try {
            $serviceCost = $request->service_costs;
            $address = $request->address;
            $apiKey = $request->api_key;
            $secretKey = $request->secret_key;

            $serviceCF = C_Config::where('name', 'service_costs')->firstOrFail();
            $serviceCF->value = $serviceCost;
            $serviceCF->save();

            $infoSysCF =  C_Config::where('name', 'info_system')->firstOrFail();
            $infoSysCFValue = json_decode($infoSysCF->value);
            $infoSysCFValue->address = $address;
            $infoSysCF->value = json_encode($infoSysCFValue);
            $infoSysCF->save();

            $keyEsms =  C_Config::where('name', 'key_esms')->firstOrFail();
            $keyEsmsValue = json_decode($keyEsms->value);
            $keyEsmsValue->api_key = $apiKey;
            $keyEsmsValue->secret_key = $secretKey;
            $keyEsms->value = json_encode($keyEsmsValue);
            $keyEsms->save();
        } catch (\Excreption $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
        
    }

}
