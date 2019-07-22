<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    CONST STATUS_NEW = 1;
    CONST STATUS_PENDING = 2;
    CONST STATUS_APPROVED = 3;
    CONST STATUS_START = 4;
    CONST STATUS_END = 5;
    CONST STATUS_AD_CANCEL = 6;
    CONST STATUS_CL_CANCEL = 7;


    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $table = 'booking_details';

    public static function getStatus($status)
    {
        if (is_numeric($status) && ($status > 0) && ($status <= 8)) {
            $tmp = array(
                1 => 'Chuyến mới đặt', 
                2 => 'Chuyến đang chờ xác nhận', 
                3 => 'Chuyến đã xác nhận', 
                4 => 'Chuyến đang thuê', 
                5 => 'Chuyến đã kết thúc', 
                6 => 'Quản trị viên đã hủy chuyến',
                7 => 'Khách thuê đã hủy chuyến'
                );
            return $tmp[$status];
        }
        return 'Not found';
    }
}
