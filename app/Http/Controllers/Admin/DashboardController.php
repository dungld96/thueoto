<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\BookingDetail;
use App\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $customer = User::whereHas("roles", function($q){ 
            $q->where("role", 1); 
        })
        ->where('status', 'active')
        ->get();
        $car = Car::where('status', 'active')->get();
        $now = Carbon::now();
        $tripInMonth = BookingDetail::where('status', BookingDetail::STATUS_END)->whereMonth('updated_at', $now->month)->get();
        $SumInMonth = BookingDetail::where('status', BookingDetail::STATUS_END)->whereMonth('updated_at', $now->month)->sum('sum_amount');
    	return view('admin.dashboard.index', ['customer'=>$customer, 'car'=>$car, 'tripInMonth' => $tripInMonth, 'SumInMonth' => $SumInMonth]);
    }
}
