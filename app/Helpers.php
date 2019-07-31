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
