<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/tracking', function (Request $request) {

	if(!$request->url)
	{
		return '402 - bad req';
	}

	$trackingData = [
		'item_type'    => $request->item_type ?? NULL
		, 'item_id'    => $request->item_id   ?? NULL
		, 'url'        => parse_url($request->url, PHP_URL_PATH)
		, 'ip'         => $_SERVER['REMOTE_ADDR']
		, 'session_id' => session_id()
	];

	$pageHit = new \App\Models\PageHit;

	foreach($trackingData as $trackingKey => $trackingValue)
	{
		$pageHit->{ $trackingKey } = $trackingValue;
	}

	$pageHit->save();

	return response($trackingData)->header('Content-Type', 'application/json');
});