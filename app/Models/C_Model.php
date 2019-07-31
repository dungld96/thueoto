<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class C_Model extends Model
{
    protected $table = 'c_models';

    public static function getModelsByMake($makeCode)
    {
        $models = self::where('make_code', $makeCode)->get();
        $modelByMakes = [];
        foreach ($models as $model) {
            if($model->make_code == $makeCode){
                $modelByMakes[] = $model;
            }
        }
        return $modelByMakes;
        
    }

    public static function getCModelNameByCode($modelCode)
    {
        $modelName = self::where('code', $modelCode)->firstOrFail();
        return $modelName->name;
    }

}
