<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sluggable;
use Illuminate\Support\Str;
class Car extends Model
{
    protected $table = 'cars';
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }
}
