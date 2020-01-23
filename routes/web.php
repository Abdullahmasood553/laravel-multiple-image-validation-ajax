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





Route::get('get_image', 'ImageController@get_image');
Route::post('get-approved-completed-jobs','ImageController@completedOrderJobModal')->name('post.completed.job.modal');


Route::get('get_posts', 'ImageController@get_posts');

Route::get('delete_post', 'ImageController@delete_post');
