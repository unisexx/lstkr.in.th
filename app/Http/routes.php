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

// phpinfo();

// Route::get('info', 'HomeController@info');

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('aboutus', 'HomeController@aboutus');
Route::get('viewlineid', 'HomeController@viewlineid');
Route::get('viewlineqrcode', 'HomeController@viewlineqrcode');

Route::get('search', 'HomeController@search');

Route::get('search/{param}', 'HomeController@search');

Route::get('new_arrival', 'HomeController@new_arrival');

Route::get('new_arrival/{param}', 'HomeController@new_arrival');

Route::get('author/{param}', 'HomeController@author');

Route::get('tag/{param}', 'HomeController@tag');

Route::controller('ajax', 'AjaxController');

Route::controller('sticker', 'StickerController');

Route::controller('theme', 'ThemeController');

Route::controller('emoji', 'EmojiController');

Route::controller('page', 'PageController');

// ดึงข้อมูล

Route::controller('crawler', 'CrawlerController');

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

// Route::get('/testimg', function () {

//     // return Image::canvas(800, 600, '#ccc')->save('bar.jpg');

//     return Image::canvas(800, 600, '#ccc')->response('jpg');

// });

// test entrust

// Route::controller('role', 'RoleController');
