<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.cars.index');
    }

    public function getAll(Request $request)
    {
    	$cars = Car::select(['id', 'code', 'name', 'seats', 'status'])->get();

    	return DataTables::of($cars)
    	->addColumn('action', function ($cars) {
            return '<a href="#edit-'.$cars->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa</a> <a href="#delete-'.$cars->id.'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-times"></i> Xóa</a>';
        })
        ->editColumn('status', function($cars) {
                    return getCarStatus($cars->status);
         })
    	->addIndexColumn()
	    ->make();
	}

    public function store(Request $request)
    {
        try {
            $car = new Car();
            $car->code = $request->code;
            $car->car_manufacturer = $request->car_manufacturer;
            $car->description = $request->description;
            $car->name = $request->name;
            $car->seats = $request->seats;
            $car->status = 2;
            $car->save();
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
}

