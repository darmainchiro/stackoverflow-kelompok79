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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('questions.index')->with('success', 'Yeyyy berhasil 😁');
    });
});

Route::get('questions/comment/{id}', 'QuestionsController@getComment')->name('questions.comment.index');
Route::post('questions/comment/{id}', 'QuestionsController@createComment')->name('questions.comment.store');

Route::get('questions/data', 'DataController@questions')->name('questions.data');
Route::resource('questions', 'QuestionsController');


Route::post('/answers/store', 'AnswersController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// UNISHAR CKEDITOR
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
