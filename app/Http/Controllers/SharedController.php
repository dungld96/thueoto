<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharedController extends Controller
{
    public function getModels($makeId)
    {
        $models = json_decode(file_get_contents(storage_path() . "/app/json/models.json"));
        $modelByMakes = [];
        foreach ($models as $model) {
            if($model->make_id == $makeId){
                $modelByMakes[] = $model;
            }
        }

        return response()->json(['message'=>'Thành công', 'status' => 'success', 'modelByMakes' => $modelByMakes]);
    }
}
