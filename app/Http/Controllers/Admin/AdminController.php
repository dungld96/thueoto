<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
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
}
