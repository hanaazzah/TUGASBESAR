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

Route::get('/', 'VoteController@index')->name('vote.index');
Route::get('/vote', 'VoteController@vote')->name('vote.look');
Route::post('/vote/find', 'VoteController@findUser')->name('vote.findUser');
Route::get('/vote_now', 'VoteController@voteNow')->name('vote.votenow');
Route::post('/vote/select', 'VoteController@select')->name('vote.select');
Route::get('/counts', 'VoteController@counts')->name('counts');

Route::get('/api/enroll_data', 'VoteController@enroll')->name('pemilih.enroll');
Route::get('/api/login', 'VoteController@loginVote')->name('pemilih.loginVote');
Route::get('/api/login/data', 'VoteController@loginData')->name('pemilih.loginData');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Kades Data
Route::get('/kades/add', 'KadesController@add')->name('kades.add');
Route::post('/kades/add', 'KadesController@store')->name('kades.store');
Route::delete('/kades/{id}', 'KadesController@delete')->name('kades.delete');

// Pemilih
Route::resource('/pemilih', 'PemilihController');
