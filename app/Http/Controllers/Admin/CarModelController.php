<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\C_Model;
use App\Models\C_Make;
use DataTables;
class CarModelController extends Controller
{
    public function index()
    {
        $makes = C_Make::all();
        return view('admin.car-models.index', ['makes' => $makes]);
    }

    public function getCarModels(Request $request)
    {
        $make_code = $request->make_code;
        $query = C_Model::join('c_makes', 'c_models.make_code', '=', 'c_makes.code')
                ->select(
                    'c_models.*',
                    'c_makes.name as makeName'
        );


        if($make_code){
            $query->where('c_models.make_code', $make_code);
        }

        $query->orderBy('c_makes.name', 'desc');
        $query = $query->get();
            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                $eView = '<a title="Sửa" data-id="'.$query->id.'" class="btnEditCModel btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
                $eDelete = '<a title="Xóa" data-id="'.$query->id.'" class="btnDeleteCModel btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>';
                return $eView.$eDelete;
                
            })
            ->editColumn('type', function ($query) {
                return $query->type.' chỗ';
            })
	        ->addIndexColumn()
            ->make();
    }

    public function create()
    {
        $c_model = new C_Model();
        $c_seats = json_decode(file_get_contents(storage_path().'/app/json/seats.json', false));

        return view('admin.car-models._edit', ['c_model' => $c_model, 'c_seats' => $c_seats]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:2',
            ],
            [
                'name.required' => 'Tên mẫu xe không được để trống',
                'name.min' => 'Tên mẫu xe phải dài hơn 2 ký tự'
            ],
            [
                'type' => 'required',
            ],
            [
                'type.required' => 'Kiểu xe không được để trống',
            ],
            [
                'make_code' => 'required',
            ],
            [
                'make_code.required' => 'Hãng xe không được để trống',
            ]);

        try {
            $c_model = new C_Model();
            $c_model->make_code = $request->make_code;
            $c_model->name = trim($request->name);
            $c_model->code = str_replace(' ', '_', $request->name);
            $c_model->type = $request->type;
            $c_model->save();
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thêm mẫu xe thành công', 'status' => 'success']);
    }

    public function edit($id)
    {
        $c_model = C_Model::find($id);
        $c_seats = json_decode(file_get_contents(storage_path().'/app/json/seats.json', false));

        return view('admin.car-models._edit', ['c_model' => $c_model, 'c_seats' => $c_seats]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:2',
            ],
            [
                'name.required' => 'Tên mẫu xe không được để trống',
                'name.min' => 'Tên mẫu xe phải dài hơn 2 ký tự'
            ],
            [
                'type' => 'required',
            ],
            [
                'type.required' => 'Kiểu xe không được để trống',
            ],
            [
                'make_code' => 'required',
            ],
            [
                'make_code.required' => 'Hãng xe không được để trống',
            ]);

        try {
            $c_model = C_Model::find($request->id);
            $c_model->make_code = $request->make_code;
            $c_model->name = trim($request->name);
            $c_model->code = str_replace(' ', '_', $request->name);
            $c_model->type = $request->type;
            $c_model->save();
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thêm mẫu xe thành công', 'status' => 'success']);
    }

    public function delete($id)
    {
        try {
            C_Model::find($id)->delete();;
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Xóa mẫu xe thành công', 'status' => 'success']);
    }


}
