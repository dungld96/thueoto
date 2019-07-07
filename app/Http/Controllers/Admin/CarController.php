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

    public function add(Request $request)
    {
        # code...
    }
}

