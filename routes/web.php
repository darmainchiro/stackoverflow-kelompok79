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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/tes', 'TesController@index');
});
Route::get('/','QuestionsController@index');  // menampilkan semua pertanyaan
Route::get('/pertanyaan/create','QuestionsController@create'); // menampilkan form untuk buat pertanyaan
Route::post('/pertanyaan/send','QuestionsController@store');

Route::get('/pertanyaan/{question}/{title}','QuestionsController@show');
Route::get('/pertanyaan/{question}','QuestionsController@edit');
Route::put('/pertanyaan/{question}/update','QuestionsController@update');
Route::delete('/pertanyaan/{question}','QuestionsController@destroy');


Route::post('/answers/store','AnswersController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// UNISHAR CKEDITOR
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

