<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
class UserController extends Controller
{

    public function getAccount(){
        $user = Auth::user();
        if(isset($user->birthday)){
            $user->birthday = Carbon::createFromFormat('Y-m-d',$user->birthday)->format('d/m/Y');
        }
        return view('client.user.account', ['user' => $user]);
    }

    public function editInfo()
    {
        $user = Auth::user();
        if(isset($user->birthday)){
            $user->birthday = Carbon::createFromFormat('Y-m-d',$user->birthday)->format('d/m/Y');
        }
    	return view('client.user._edit_info', ['user' => $user]);
    }

    public function saveInfo(Request $request)
    {

    	try {
	    	$user = Auth::user();
	    	$user->name = $request->name;
	    	$user->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->toDateTimeString();
	    	$user->sex = $request->sex;
	    	$user->save();
    	} catch (\Exception $e) {
    		return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
    	}
		return response()->json(['message'=>'Thành công', 'status' => 'success']);

    }

    public function editPhoneNumber( )
    {
        $user = Auth::user();
        return view('client.user._edit_phone_number', ['user' => $user]);
    }


    public function savePhoneNumber(Request $request )
    {

        $validatedData = $request->validate(
            [
                'phone_number' => 'required|regex:/^[0-9]{9,15}$/',
            ],
            [
                'phone_number.required' => 'Số điện thoại không được để trống',
                'phone_number.regex' => 'Số điện thoại không hợp lệ'
            ]);

        try {
            $user = Auth::user();
            $user->phone_number = $request->phone_number;
            $user->save();
        } catch (\Exception $e) {
            if($e->errorInfo[1] == 1062){
                $message = 'Số điện thoại đã tồn tại.';
            }else{
                $message = $e->getMessage();
            }
            return response()->json(['message'=>$message, 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }


    public function editEmail( )
    {
        $user = Auth::user();
        return view('client.user._edit_email', ['user' => $user]);
    }

    public function saveEmail(Request $request )
    {

        $validatedData = $request->validate(
            [
                'email' => 'required|regex:/^.+@.+$/',
            ],
            [
                'email.required' => 'Email không được để trống',
                'email.regex' => 'Email không hợp lệ'
            ]);

        try {
            $user = Auth::user();
            $user->email = $request->email;
            $user->save();
        } catch (\Exception $e) {
            if($e->errorInfo[1] == 1062){
                $message = 'Email đã tồn tại.';
            }else{
                $message = $e->getMessage();
            }
            return response()->json(['message'=>$message, 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function changePassword()
    {
        return view('auth.change-password');
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
