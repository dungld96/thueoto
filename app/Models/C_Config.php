<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class C_Config extends Model
{
    protected $table = 'c_configs';
    
    public static function getServiceCosts()
    {
        $config = self::where('name', 'service_costs')->firstOrFail();
        return $config->value;
    }
    public static function getInfoSystemCf()
    {
        $infoSystemCf = C_Config::where('name', 'info_system')->firstOrFail();
        return json_decode($infoSystemCf->value);
    }
}
