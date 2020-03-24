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

Route::get('/', 'IdeasController@ideas');
Route::get('/pomysl/{idea_id}', 'IdeasController@idea');
Route::post('/pomysl/{idea_id}/nowy-komentarz', 'IdeasController@saveNewComment');
Route::get('/nowy-pomysl', 'IdeasController@newIdea');
Route::post('/nowy-pomysl', 'IdeasController@saveNewIdea');
Route::post('/pomysl/{idea_id}/glos', 'IdeasController@saveIdeaVote');
Route::post('/komentarz/{comment_id}/glos', 'IdeasController@saveCommentVote');
