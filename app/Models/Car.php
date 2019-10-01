<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sluggable;
use Illuminate\Support\Str;
use App\Models\BookingDetail;


class Car extends Model
{
    protected $table = 'cars';
    use Sluggable;

    public function booking_details()
    {
        return $this->hasMany(BookingDetail::class);
    }

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
