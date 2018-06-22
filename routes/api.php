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
	$trackingData = [
		'item_type'    => $request->item_type
		, 'item_id'    => $request->item_id
		, 'url'        => $request->url
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