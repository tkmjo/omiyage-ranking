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

Route::get('/', 'OmiyagesController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// お土産情報
Route::resource('omiyages', 'OmiyagesController');


Route::group(['middleware' => 'auth'], function() {
    // お気に入り
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::post('favorite', 'UserFavoriteController@store')->name('user.favorite');
        Route::delete('unfavorite', 'UserFavoriteController@destroy')->name('user.unfavorite');
        Route::get('favoriting', 'UsersController@favoriting')->name('users.favoriting');
        // Route::get('favorited', 'OmiyagesController@favorited')->name('omiyages.favorited');
    });
});

// ランキング

Route::get('ranking/{prefecture}', 'RankingController@rank')->name('ranking.rank');

