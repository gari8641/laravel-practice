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

// Eloquent モデルの削除 p255
Route::get('person/del', 'PersonController@delete');
Route::post('person/del', 'PersonController@remove');

// Eloquent リレーション 別のテーブル（boards）追加 p266
Route::get('board', 'BoardController@index');

Route::get('board/add', 'BoardController@add');
Route::post('board/add', 'BoardController@create');


// 最初から用意されてるCRUD処理のroute(この練習の場合、RestappControllerのメソッドすべて) p289
Route::resource('rest', 'RestappController');

// Rest. helloのページからRestにアクセスする p293
Route::get('hello/rest', 'HelloController@rest');

// sessoin. p299
Route::get('hello/session', 'HelloController@ses_get');
Route::post('hello/session', 'HelloController@ses_put');
