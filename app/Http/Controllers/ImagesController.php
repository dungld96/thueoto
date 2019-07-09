<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function imageStore(Request $request)
    {
    	$image = $request->file;
    	$imageName = uniqid(). "_" . trim($image->getClientOriginalName());
    	$image->storeAs('uploads', $imageName);
        return response()->json([
	        'name'          => $imageName,
	        'original_name' => $image->getClientOriginalName(),
	    ]);
    }
}
