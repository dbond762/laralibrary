<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

Route::prefix('/books')->group(function () {
    Route::get('/', 'Books@index');
    Route::get('/authors', 'Books@authors');
    Route::get('/author/{author_id}', 'Books@bookAuthors');
    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('/my', 'Books@my');
        Route::post('/', 'Books@create');
        Route::put('/{book_id}', 'Books@edit');
        Route::delete('/{book_id}', 'Books@delete');
    });
});
