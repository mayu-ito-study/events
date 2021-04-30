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

Route::get('/', 'EventsController@index');
Route::resource('events', 'EventsController');

// CRUD省略部
// イベントの個別詳細ページ表示
// Route::get('events/{id}', 'EventsController@show');

// イベントの新規登録を処理（新規登録画面を表示するためのものではありません）
// Route::post('events', 'EventsController@store');

// イベントの更新処理（編集画面を表示するためのものではありません）
// Route::put('events/{id}', 'EventsController@update');

// イベントを削除
// Route::delete('events/{id}', 'EventsController@destroy');

// index: showの補助ページ
// Route::get('events', 'EventsController@index');

// create: 新規イベント投稿用のフォームページ
// Route::get('events/create', 'EventsController@create')->name('events.create');

// edit: 更新用のフォームページ
// Route::get('events/{id}/edit', 'EventsController@edit')->name('events.edit');

// ユーザー登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'EventsController', ['only' => ['store', 'update', 'destroy']]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        //HTTPでユーザをフォローする
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        //HTTPでユーザをアンフォローする
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        //フォローしているユーザ一覧を表示する
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        //フォローされてているユーザ一覧を表示する
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        // お気に入り一覧を表示する
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
        // 投稿一覧を表示する
        Route::get('events', 'EventsController@user_events')->name('users.user_events');
    });

    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    Route::group(['prefix' => 'events/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::resource('events', 'EventsController', ['only' => ['store', 'destroy']]);

});