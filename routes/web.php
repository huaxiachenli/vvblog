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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'users/{user_id}'],function (){
    Route::get('dashboard','UsersController@dashboard')->name('dashboard');
    Route::get('search','ArticlesController@search')->name('search');
    Route::resource('articles','ArticlesController');
    Route::resource('categories','CategoriesController',['only'=>['store','destory','show']]);
    Route::resource('child_categories','ChildCategoriesController',['only'=>['store','destory','show']]);
    Route::resource('profiles','ProfilesController',['only'=>['store']]);

});

Route::group(['prefix'=>'articles/{article}'],function(){
    Route::post('support','ArticlesController@support');
    Route::post('unsupport','ArticlesController@unsupport');

});

Route::resource('professions','ProfessionsController');

Route::resource('users','UsersController');

Route::resource('collects','CollectsController',['only'=>['store','destroy']]);

Route::resource('likeables','LikeablesController',['only'=>['store','destroy']]);

Route::resource('comments','CommentsController',['only'=>['store','update']]);




