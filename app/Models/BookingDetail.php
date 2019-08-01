<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class BookingDetail extends Model
{
    CONST STATUS_NEW = 1;
    CONST STATUS_PENDING = 2;
    CONST STATUS_APPROVED = 3;
    CONST STATUS_START = 4;
    CONST STATUS_PENDING_END = 5;
    CONST STATUS_END = 6;
    CONST STATUS_AD_CANCEL = 7;
    CONST STATUS_CL_CANCEL = 8;

    protected $table = 'booking_details';

    public function cars()
    {
      return $this->belongsTo(Car::class);
    }

    public static function getStatus($status)
    {
        if (is_numeric($status) && ($status > 0) && ($status <= 8)) {
            $tmp = array(
                1 => 'Chuyến mới đặt', 
                2 => 'Chuyến chờ xác nhận đặt xe', 
                3 => 'Chuyến đã xác nhận', 
                4 => 'Chuyến đang thuê', 
                5 => 'Chuyến chờ xác nhận trả xe', 
                6 => 'Chuyến đã kết thúc', 
                7 => 'Quản trị viên đã hủy chuyến',
                8 => 'Khách thuê đã hủy chuyến'
                );
            return $tmp[$status];
        }
        return 'Not found';
    }
}
