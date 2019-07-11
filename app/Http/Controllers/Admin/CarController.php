<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Car;
use App\Models\CarImages;

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
            return 
            '<a data-id="'.$cars->id.'" class="btnEditCar btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa</a> 
            <a data-id="'.$cars->id.'" class="btnDeleteCar btn btn-xs btn-danger btn-delete"><i class="fa fa-times"></i> Xóa</a>';
        })
        ->editColumn('status', function($cars) {
                    return getCarStatus($cars->status);
         })
    	->addIndexColumn()
	    ->make();
	}

    public function store(Request $request)
    {
        $files = $request->input('document', []);
        try {
            $car = new Car();
            $car->code = $request->code;
            $car->car_manufacturer = $request->car_manufacturer;
            $car->description = $request->description;
            $car->name = $request->name;
            $car->seats = $request->seats;
            $car->costs = $request->costs;
            $car->status = 2;
            $car->thumbnail = $files[0];
            $car->save();

            foreach ( $files as $file) {
                $carImage = new CarImages;
                $carImage->car_id = $car->id;
                $carImage->name = $file;
                $carImage->save();
            }
            
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        
    }

    public function create()
    {
        return view('admin.cars._edit');
    }

    public function delete($id)
    {
        try {
            $car = Car::find($id);
            if ($car) {
               $car->delete();
            }
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function edit($id)
    {
        $car = Car::find($id);
        return view('admin.cars._edit', ['car' => $car]);
    }

}

