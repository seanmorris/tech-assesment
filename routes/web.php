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

Route::get('/', function () {

	return redirect('home');
});

Route::get('/home', function () {
	return view('chrome', [
		'content' => view('home')
	]);
});

Route::get('/about', function () {
	return view('chrome', [
		'content' => view('about')
	]);
});


Route::get('/blank', function () {
	return view('chrome', [
		'content' => view('blank')
	]);
});

Route::get('/news', function () {
	$articles = \App\Models\Article::with('images')
		->orderBy('id', 'desc')
		->paginate(30);

	return view('chrome', [
		'content' => view('news', [
			'articles' => $articles
		])
	]);
});

Route::get('/news/{articleId}', function ($articleId) {
	if(!$article = \App\Models\Article::where('id', $articleId)->first())
	{
		abort(404);
	}

	$image   = $article->images()->first();

	$imageCrop = NULL;

	if($image)
	{
		$imageCrop = $image->crop(950, 400);
	}

	return view('chrome', [
		'content' => view('article', [
			'article'    => $article
			, 'image'    => $imageCrop
			, 'tracking' => $article->trackingData()
		])
	]);
});

Route::get('/events', function () {
	$events = \App\Models\Event::orderBy('id', 'desc')->paginate(30);

	return view('chrome', [
		'content' => view('events', [
			'events' => $events
		])
	]);
});

Route::get('/events/{eventId}', function ($eventId) {
	if(!$event = \App\Models\Event::where('id', $eventId)->first())
	{
		abort(404);
	}

	$image = $event->images()->first();

	$imageCrop = NULL;

	if($image)
	{
		$imageCrop = $image->crop(475, 475);
	}

	$encodedLocation = urlencode($event->location);

	return view('chrome', [
		'content' => view('event', [
			'encodedLocation' => $encodedLocation
			, 'event'         => $event
			, 'image'         => $imageCrop
			, 'tracking'      => $event->trackingData()
		])
	]);
});

Route::get('/tracking', function () {
	$from = date('Y-m-d', strtotime($_GET['from'] ?? '7 days ago'));
	$to   = date('Y-m-d', strtotime($_GET['to']   ?? 'now'));

	$uniqueHits = 0;
	$totalHits  = 0;

	\App\Models\PageHit::countLoader()
	->whereBetween('created_at', array($from, $to . ' 23:59:59'))
	->chunk(500,
		function($pageHitGroup) use(&$uniqueHits, &$totalHits) {
			foreach ($pageHitGroup as $pageHits)
			{
				$uniqueHits += $pageHits->unique_hit_count;
				$totalHits  += $pageHits->hit_count;
			}
		}
	);

	return view('chrome', [
		'content' => view('tracking', [
			'content'      => view('blank')
			, 'from'       => $from
			, 'to'         => $to
			, 'uniqueHits' => $uniqueHits
			, 'totalHits'  => $totalHits
		])
	]);
});

Route::get('/tracking/export', function () {
	$from = date('Y-m-d', strtotime($_GET['from'] ?? '7 days ago'));
	$to   = date('Y-m-d', strtotime($_GET['to']   ?? 'now'));

	header(sprintf(
		'Content-Disposition: attachment; filename=tracking_%s-%s.csv'
		, $from
		, $to
	));
	header('Content-type: application/csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['url', 'unique hits', 'total hits']);

	\App\Models\PageHit::countLoader()
	->whereBetween('created_at', array($from, $to . ' 23:59:59'))
	->chunk(500,
		function($pageHits) use(&$output){
			foreach($pageHits as $pageHit)
			{
				fputcsv($output, [
					$pageHit->url
					, $pageHit->unique_hit_count
					, $pageHit->hit_count
				]);
			}
		}
	);

	fclose($output);
});
