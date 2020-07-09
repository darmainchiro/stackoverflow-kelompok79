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
    return view('stackoverflow.index');
});

Route::get('/pertanyaan','QuestionsController@index');  // menampilkan semua pertanyaan
Route::get('/pertanyaan/buat','QuestionsController@create'); // menampilkan form untuk buat pertanyaan
Route::post('/pertanyaan/kirim','QuestionsController@store');

Route::get('/pertanyaan/{question}/{judul}','QuestionsController@show');
Route::get('/pertanyaan/{question}','QuestionsController@edit');
Route::put('/pertanyaan/{question}/update','QuestionsController@update');
Route::delete('/pertanyaan/{question}','QuestionsController@destroy');

