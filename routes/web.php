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

/*
Route::get('/', function () {
    return view('welcome');
});

 */



Route::get('/', function(){return redirect('/tasks');});
Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');
Route::delete('/tasks/{id}', 'TaskController@destroy');



use App\Http\Middleware\HelloMiddleWare;

Route::get('/hello', 'HelloController@index');
Route::post('/hello', 'HelloController@post');

Route::get('/hello/add', 'HelloController@add');
Route::post('/hello/add', 'HelloController@create');

Route::get('/hello/edit', 'HelloController@edit');
Route::post('/hello/edit', 'HelloController@update');

Route::get('/hello/del', 'HelloController@del');
Route::post('/hello/del', 'HelloController@remove');

Route::get('/hello/show', 'HelloController@show');


Route::get('person', 'PersonController@index');


Route::get('person/find', 'PersonController@find');
Route::post('person/find', 'PersonController@search');


// Eloquent モデルの作成 p249
Route::get('person/add', 'PersonController@add');
Route::post('person/add', 'PersonController@create');

// Eloquent モデルの更新 p253
Route::get('person/edit', 'PersonController@edit');
Route::post('person/edit', 'PersonController@update');
