<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use File;
use App\Models\Car;
use App\Models\C_Make;
use App\Models\C_Model;
use App\Models\CarImages;
use App\Models\BookingDetail;

class CarController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.cars.index');
    }

    public function getAll(Request $request)
    {
    	$cars = Car::select(['id', 'code', 'name', 'costs', 'promotion_costs', 'status'])->get();

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
            $car->make_code = $request->make_code;
            $car->model_code = $request->model_code;
            $car->car_year = $request->car_year;
            $car->name = $request->model_code.' '.$request->car_year;
            $car->number_plate = $request->number_plate;
            $car->transmission = $request->transmission;
            $car->fuel = $request->fuel;
            $car->description = $request->description;
            $car->seats = $request->seats;
            $car->costs = $request->costs;
            $car->promotion_costs = $request->promotion_costs;
            $car->status = $request->status;
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
        $car->code = $this->generateCarCode();
        $makes = C_Make::all();
        return view('admin.cars._edit', ['car' => $car, 'makes' => $makes]);
    }

    public function delete($id)
    {
        try {
            $allTripByCar = BookingDetail::where('car_id', $id)->get();
            if(count($allTripByCar) > 0){
                foreach ($allTripByCar as $trip) {
                    if($trip->status != BookingDetail::STATUS_START && $trip->status != BookingDetail::STATUS_PENDING_END){
                        $trip->status = BookingDetail::STATUS_AD_CANCEL;
                        $trip->save();
                    }else{
                        return response()->json(['message'=>'Xe đang được thuê không thể xóa', 'status' => 'error']);
                    }
                }
            }

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
        return response()->json(['message'=>'Xóa xe thành công', 'status' => 'success']);
    }

    public function edit($id)
    {
        $car = Car::find($id);
        $makes = C_Make::all();
        $images = CarImages::select('name')->where('car_id', $id)->get();
        foreach ($images as $i=> $img) {
            $img->size = File::size('uploads/'.$img->name);
            
        }
        return view('admin.cars._edit', ['car' => $car, 'images' => $images, 'makes' => $makes]);
    }

    public function update(Request $request)
    {
        $files = $request->input('document', []);
        try {
            $car = Car::find($request->id);

            $car->code = $request->code;
            $car->make_code = $request->make_code;
            $car->model_code = $request->model_code;
            $car->car_year = $request->car_year;
            $car->name = C_Model::getCModelNameByCode($request->model_code).' '.$request->car_year;
            $car->number_plate = $request->number_plate;
            $car->transmission = $request->transmission;
            $car->fuel = $request->fuel;
            $car->description = $request->description;
            $car->seats = $request->seats;
            $car->costs = $request->costs;
            $car->promotion_costs = $request->promotion_costs;
            $car->status = $request->status;
            $car->thumbnail = isset($files[0]) ? $files[0] : '';
            
            if($request->status == 'inactive'){
                $allTripByCar = BookingDetail::where('car_id', $request->id)->get();
                if(count($allTripByCar) > 0){
                    foreach ($allTripByCar as $trip) {
                        if($trip->status != BookingDetail::STATUS_START && $trip->status != BookingDetail::STATUS_PENDING_END){
                            $trip->status = BookingDetail::STATUS_AD_CANCEL;
                            $trip->save();
                        }else{
                            return response()->json(['message'=>'Xe đang được thuê không thẻ chuyển sang không hoạt động', 'status' => 'error']);
                        }
                    }
                }
            }

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

    public function generateCarCode()
	{
		$str = "";
		$characters = array_merge(range('A','Z'),range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 5; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		$checkFound = Car::where('code', $str);
		if ($checkFound->exists()) {
			$this->generateTripCode();
		}else{
			return $str;
		}
    }
    

}

