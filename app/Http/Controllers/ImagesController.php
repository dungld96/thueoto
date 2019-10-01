<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

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
	
	public function imageRemove(Request $request)
	{
		try {
			$name = $request->name;
			File::delete('uploads/'.$name);
			return response()->json(['message'=>'Thành công', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
	}

}
