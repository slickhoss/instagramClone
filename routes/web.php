<?php
use App\Mail\NewUserMail;

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
    return view('welcome');
});

Auth::routes();
//route for profile view
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

//route for create post view
Route::get('/p/create', 'PostsController@create');
//route to save post
Route::post('/p', 'PostsController@store');

//route to view post
Route::get('/p/{post}', 'PostsController@show');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::get('/profile/{user}/followers', 'ProfilesController@followers');

Route::get('/profile/{user}/following', 'ProfilesController@following');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/', 'PostsController@index');

Route::get('/explore', 'ProfilesController@explore');

Route::get('/email', function(){
    return new NewUserMail();
});


//test route
Route::get('/p/comment/{post}', 'CommentsController@createComment');
Route::post('/p/comment/{post}/store', 'CommentsController@store');

Route::get('/like/p/{post}', 'LikesController@store');

Route::get('likedby/{post}', 'PostsController@likedBy');

Route::get('/p/delete/{post}', 'PostsController@delete');

