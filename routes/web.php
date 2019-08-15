<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/uploadPhoto', function(Request $request){	

	if($request->hasFile('photo'))
	{
		$img = Image::make($request->file('photo')->getRealPath());
		$real_img = Image::make($request->file('photo')->getRealPath());
		$real_img->encode('png');
		$type = 'png';
		$img->brightness($request->get('brightness'))
			->blur($request->get('blur'))
			->contrast($request->get('contrast'))
			->encode('png');
		$modified_image = 'data:image/' . $type . ';base64,' . base64_encode($img);
		$original_image = 'data:image/' . $type . ';base64,' . base64_encode($real_img);
		echo json_encode([ "original_image" => $original_image,
			"modified_image" => $modified_image,
		]);
	}
	
});