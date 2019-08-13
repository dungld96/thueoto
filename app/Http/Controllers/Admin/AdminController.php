<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Role;
use DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
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
        
            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt('vinhtin123');
                $user->save();
                $user->roles()->attach(Role::where('role', 2)->first());
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
        try {
            User::find($id)->delete();;
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa tài khoản thành công', 'status' => 'success']);
    }

}
