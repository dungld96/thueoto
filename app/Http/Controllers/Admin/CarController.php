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
use DB;

class CarController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.cars.index');
    }

    public function getAll(Request $request)
    {
        $inpCarFilters = $request->car_filter_params;
        $isTop = 'F';
        
        $query = Car::select(['id', 'code', 'name', 'costs', 'promotion_costs', 'is_top', 'status']);

        if (is_array($inpCarFilters) || is_object($inpCarFilters))
        {
            foreach ($inpCarFilters as $param) {
                if($param['name'] == 'is_top') {
                    $query->where('is_top', $param['value']);
                }
            }
        }

        $query->orderBy('updated_at', 'desc');
        $query->orderBy('created_at', 'desc');

        $query = $query->get();
    	return DataTables::of($query)
    	->addColumn('action', function ($query) {
            return 
            '<a data-id="'.$query->id.'" class="btnEditCar btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa</a> 
            <a data-id="'.$query->id.'" class="btnDeleteCar btn btn-xs btn-danger btn-delete"><i class="fa fa-times"></i> Xóa</a>';
        })
        ->editColumn('status', function($query) {
                    return getCarStatus($query->status);
         })
    	->addIndexColumn()
	    ->make();
	}

    public function store(Request $request)
    {
        $files = $request->input('document', []);
        DB::beginTransaction();
        try {
            $car = new Car();
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
            $car->consumption = $request->consumption;
            $car->costs = $request->costs;
            $car->promotion_costs = $request->promotion_costs;
            $car->is_top = isset($request->is_top) && $request->is_top == 'T' ? 'T' : 'F';
            $car->status = $request->status;
            $car->thumbnail = isset($files[0]) ? $files[0] : '';
            $car->car_spec = $request->car_spec;

            $function = [
                'sr' => isset($request->sr) && $request->sr == 'T' ? true : false,
                'gp' => isset($request->gp) && $request->gp == 'T' ? true : false,
                'bs' => isset($request->bs) && $request->bs == 'T' ? true : false,
                'sc' => isset($request->sc) && $request->sc == 'T' ? true : false,
                'bt' => isset($request->bt) && $request->bt == 'T' ? true : false,
                'us' => isset($request->us) && $request->us == 'T' ? true : false,
                'mp' => isset($request->mp) && $request->mp == 'T' ? true : false
            ];

            $car->function = json_encode($function);
            $car->save();

            if(isset($files)){
                foreach ( $files as $file) {
                    $carImage = new CarImages;
                    $carImage->car_id = $car->id;
                    $carImage->name = $file;
                    $carImage->save();
                }
            }
            DB::commit();
            return response()->json(['message'=>'Thêm xe thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            if($e->errorInfo[1] == 1062){
                $message = 'Biển số xe hoặc mã xe đã tồn tại.';
            }else{
                $message = $e->getMessage();
            }
            return response()->json(['message'=>$message, 'status' => 'error']);
        }
        
    }

    public function create()
    {
        $car = new Car();
        $car->code = $this->generateCarCode();
        $car->consumption = 10;
        $makes = C_Make::all();
        $c_seats = json_decode(file_get_contents(storage_path().'/app/json/seats.json', false));

        $carFunction = [
            'sr' => false,
            'gp' => false,
            'bs' => false,
            'sc' => false,
            'bt' => false,
            'us' => false,
            'mp' => false
        ];

        $carFunction = json_decode(json_encode($carFunction));
        return view('admin.cars._edit', ['car' => $car, 'makes' => $makes, 'c_seats' => $c_seats, 'carFunction' => $carFunction]);
    }

    public function delete($id)
    {
        DB::beginTransaction();
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
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa xe thành công', 'status' => 'success']);
    }

    public function edit($id)
    {
        $car = Car::find($id);
        $carFunction = json_decode($car->function);
        $makes = C_Make::all();
        $images = CarImages::select('name')->where('car_id', $id)->get();
        foreach ($images as $i=> $img) {
            $img->size = File::size('uploads/'.$img->name);
            
        }
        $c_seats = json_decode(file_get_contents(storage_path().'/app/json/seats.json', false));
        return view('admin.cars._edit', [
            'car' => $car, 
            'images' => $images, 
            'makes' => $makes, 
            'c_seats' => $c_seats, 
            'carFunction' => $carFunction
        ]);
    }

    public function update(Request $request)
    {
        $files = $request->input('document', []);
        DB::beginTransaction();
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
            $car->consumption = $request->consumption;
            $car->costs = $request->costs;
            $car->promotion_costs = $request->promotion_costs;
            $car->is_top = isset($request->is_top) && $request->is_top == 'T' ? 'T' : 'F';
            $car->status = $request->status;
            $car->thumbnail = isset($files[0]) ? $files[0] : '';
            $car->car_spec = $request->car_spec;
            
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

            $function = [
                'sr' => isset($request->sr) && $request->sr == 'T' ? true : false,
                'gp' => isset($request->gp) && $request->gp == 'T' ? true : false,
                'bs' => isset($request->bs) && $request->bs == 'T' ? true : false,
                'sc' => isset($request->sc) && $request->sc == 'T' ? true : false,
                'bt' => isset($request->bt) && $request->bt == 'T' ? true : false,
                'us' => isset($request->us) && $request->us == 'T' ? true : false,
                'mp' => isset($request->mp) && $request->mp == 'T' ? true : false
            ];

            $car->function = json_encode($function);
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
            DB::commit();
            return response()->json(['message'=>'Thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            if($e->errorInfo[1] == 1062){
                $message = 'Biển số xe hoặc mã xe đã tồn tại.';
            }else{
                $message = $e->getMessage();
            }
            return response()->json(['message'=>$message, 'status' => 'error']);
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

