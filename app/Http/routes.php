<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

// Route::get('/', function () {
    // return view('welcome');
// });

// Route::controller('sticker', 'StickerController');
// Route::controller('theme', 'ThemeController');

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('search', 'HomeController@search');
Route::get('author/{param}', 'HomeController@author');
Route::get('tag/{param}', 'HomeController@tag');

Route::get('/sticker', 'StickerController@getIndex');
Route::get('/sticker/{param}', 'StickerController@getView');

Route::get('/theme', 'ThemeController@getIndex');
Route::get('/theme/{param}', 'ThemeController@getView');

Route::get('/page', 'PageController@getIndex');
Route::get('/page/{param}', 'PageController@getView');

// เช็กล็อกอิน
Route::group(['middleware' => 'auth'], function () {

    // Creator
    Route::group(['prefix' => 'creator', 'namespace' => 'Creator'], function () {
        Route::controller('dashboard', 'DashboardController');
        Route::controller('sticker', 'StickerController');
        Route::controller('theme', 'ThemeController');
        Route::controller('page', 'PageController');
        Route::controller('lucky', 'LuckyController');
    });

}); //middleware

Route::get('/test', function () {
    $crawler = Goutte::request('GET', 'https://duckduckgo.com/html/?q=Laravel');
    $crawler->filter('.result__title .result__a')->each(function ($node) {
        dump($node->text());
    });
    return view('welcome');
});

Route::get('/testimg', function () {
    // return Image::canvas(800, 600, '#ccc')->save('bar.jpg');
    return Image::canvas(800, 600, '#ccc')->response('jpg');
});

// test entrust
Route::controller('role', 'RoleController');