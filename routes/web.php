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

    $articles = \App\Models\Article::orderBy('id', 'desc')->paginate(30);

    return view('chrome', [
        'content' => view('news', [
            'articles' => $articles
        ])
    ]);
});

Route::get('/news/{articleId}', function ($articleId) {

    $article = \App\Models\Article::where('id', $articleId)->first();
    $image   = $article->images()->first();

    $imageCrop = NULL;

    if($image)
    {
        $imageCrop = $image->crop(640, 480);
    }

    return view('chrome', [
        'content' => view('article', [
            'article' => $article
            , 'image' => $imageCrop
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

    $event = \App\Models\Event::where('id', $eventId)->first();

    $encodedLocation = urlencode($event->location);

    return view('chrome', [
        'content' => view('event', [
            'encodedLocation' => $encodedLocation
            , 'event'         => $event
        ])
    ]);
});
