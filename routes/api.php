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

Route::get('/user/{username}',"UserController@find");

Route::delete('/user/{nama}','UserController@delete');

Route::patch('/user/{email}','UserController@update');

Route::get('/game', "GameController@all");

Route::post('/game','GameController@register');

Route::get('/game/{id}',"gameController@find");

Route::delete('/game/{id}',"gameController@delete");

Route::put('/game/{id}','GameController@update');

Route::get('/comment','CommentController@all');

Route::post('/game/comment/{id}','CommentController@register');

Route::get('/user/comment/{id}',"UserController@getComment");

Route::get('/game/comment/{id}', "GameController@getComment");

Route::delete('/game/comment/{id}','CommentController@delete');


Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login')->name('login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});
