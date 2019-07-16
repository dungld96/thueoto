<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use File;
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
            $car->thumbnail = isset($files[0]) ? $files[0] : '';
            $car->save();

            if(isset($files)){
                foreach ( $files as $file) {
                    $carImage = new CarImages;
                    $carImage->car_id = $car->id;
                    $carImage->name = $file;
                    $carImage->save();
                }
            }
            
            return response()->json(['message'=>'Thêm xe thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        
    }

    public function create()
    {
        $car = new Car();

        return view('admin.cars._edit', ['car' => $car]);
    }

    public function delete($id)
    {
        try {
            $images = CarImages::select('id','name')->where('car_id', $id)->get()->toArray();;
            $idImages_to_delete = array_map(function($item){ return $item['id']; }, $images);
            foreach ($images as $img) {
			    File::delete('uploads/'.$img['name']);
            }

            CarImages::whereIn('id', $idImages_to_delete)->delete();
            Car::find($id)->delete();;

        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }

    public function edit($id)
    {
        $car = Car::find($id);
        $images = CarImages::select('name')->where('car_id', $id)->get();
        foreach ($images as $i=> $img) {
            $img->size = File::size('uploads/'.$img->name);
            
        }
        return view('admin.cars._edit', ['car' => $car, 'images' => $images]);
    }

    public function update(Request $request)
    {
        $files = $request->input('document', []);
        try {
            $car = Car::find($request->id);
            $car->code = $request->code;
            $car->car_manufacturer = $request->car_manufacturer;
            $car->description = $request->description;
            $car->name = $request->name;
            $car->seats = $request->seats;
            $car->costs = $request->costs;
            $car->status = 2;
            $car->thumbnail = $files[0];
            $car->save();

            $images = CarImages::select('id','name')->where('car_id', $request->id)->get()->toArray();
            $idImages_to_delete = array_map(function($item){ return $item['id']; }, $images);
            CarImages::whereIn('id', $idImages_to_delete)->delete();

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

}

