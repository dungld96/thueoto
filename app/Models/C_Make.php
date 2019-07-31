<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class C_Make extends Model
{
    protected $table = 'c_makes';

    public static function getCMakelNameByCode($makeCode)
    {
        $makeName = $this->where('code', $makeCode)->get()->name;
        return $makeName;
    }
    
}
