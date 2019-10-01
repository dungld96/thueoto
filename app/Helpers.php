<?php


if (! function_exists('getCarStatus')) {
	function getCarStatus($status) {
        switch ($status) {
        	case 'active':
        		return "Hoạt động";
        		break;
        	case 'inactive':
        		return "Không hoạt động";
        		break;
        	default:
        		return "Không hoạt động";
        		break;
        }
    }
}

if (! function_exists('getNameTransmission')) {
	function getNameTransmission($code) {
        switch ($code) {
        	case 'auto':
        		return "Số tự động";
        		break;
        	case 'manual':
        		return "Số sàn";
        		break;
        	default:
        		return "Chưa rõ";
        		break;
        }
    }
}

if (! function_exists('getNameFuel')) {
	function getNameFuel($code) {
        switch ($code) {
        	case 'diesel':
        		return "Dầu Diesel";
        		break;
        	case 'petrol':
        		return "Xăng";
        		break;
        	default:
        		return "Chưa rõ";
        		break;
        }
    }
}
