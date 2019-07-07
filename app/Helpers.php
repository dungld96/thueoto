<?php


if (! function_exists('getCarStatus')) {
	function getCarStatus($status) {
        switch ($status) {
        	case 1:
        		return "Inactive";
        		break;
        	case 2:
        		return "Active";
        		break;
        	case 3:
        		return "Booking";
        		break;
        	case 4:
        		return "Booked";
        		break;
        	default:
        		return "Inactive";
        		break;
        }
    }
}
