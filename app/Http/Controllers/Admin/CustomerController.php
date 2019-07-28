<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Role;
use DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getCustomers()
    {
        $query = User::whereHas("roles", function($q){ $q->where("role", 1); })->get();
            
    	return Datatables::of($query)
            ->addColumn('action', function ($query) {
                return 
                '<a title="Xem" data-id="'.$query->id.'" class="btnViewTrip btn btn-xs btn-info"><i class="fas fa-eye"></i></a>';
            })
            ->editColumn('created_at', function ($query) {
                return date('d/m/Y', strtotime($query->startDate));
            })
	        ->addIndexColumn()
            ->make();
    }
}
