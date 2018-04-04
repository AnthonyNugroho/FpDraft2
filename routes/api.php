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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user',"UserController@all");

Route::post('/user',"UserController@register");

Route::get('/user/{name}',"UserController@find");

Route::delete('/user/{nama}','UserController@delete');

Route::patch('/user/update/{email}','UserController@update');

Route::get('/game', "GameController@all");

Route::post('/game','GameController@register');

Route::get('/game/{title}',"gameController@find");

Route::delete('/game/{title}',"gameController@delete");

Route::patch('/game/update/{title}','GameController@update');

Route::get('/game/comment/all','CommentController@all');

Route::post('/game/comment','CommentController@register');

Route::get('/user/comment/{id}',"UserController@getComment");

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
