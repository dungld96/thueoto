<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\C_Model;

class SharedController extends Controller
{
    public function getModels($makeCode)
    {
        try {
            $modelByMakes = C_Model::getModelsByMake($makeCode);
        } catch (\Exception $e) {
    		return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
        return response()->json(['message'=>'Thành công', 'status' => 'success', 'modelByMakes' => $modelByMakes]);
    }
}
