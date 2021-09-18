<?php

use Illuminate\Support\Facades\Route;

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
});*/

Route::get('/', function () {
    return view('bienvenue');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/vote/archive', 'VoteController@archive')->name('vote.archive');
Route::patch('/vote/{id}/restore', 'VoteController@restore')->name('vote.restore');
Route::resource('/vote', 'VoteController');
Route::get('/condidat/archive', 'CondidatController@archive')->name('condidat.archive');
Route::patch('/condidat/{id}/restore', 'CondidatController@restore')->name('condidat.restore');
Route::resource('/condidat', 'CondidatController');
Route::get('/vote.condidat.idex', 'VoteCondidatController@index')->name('vote.condidat.idex');
Route::get('/condidat.vote', 'VoteCondidatController@countVote')->name('condidat.vote');
Route::resource('/vote_deadline', 'VoteTimeOutController');