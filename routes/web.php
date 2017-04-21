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

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();


//Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'users/{user_id}'],function (){
    Route::get('tag/{tag}','TagsController@show')->name('tag');
    Route::get('search','ArticlesController@search')->name('search');
    Route::get('/articles','ArticlesController@index')->name('users.articles.index');
    Route::get('/articles/{article}','ArticlesController@show')->name('users.articles.show');
    Route::get('/categories/{category}','CategoriesController@show')->name('users.categories.show');
    Route::get('/child_categories/{child_category}','ChildCategoriesController@show')->name('users.child_categories.show');
//    Route::resource('categories','CategoriesController',['only'=>['store','destroy','show']]);
//    Route::resource('categories','admin\CategoriesController',['only'=>['store','destroy','show']]);

    Route::resource('profiles','ProfilesController',['only'=>['store']]);
//    Route::resource('professions','admin\ProfessionsController',['only'=>['store','destroy','show']]);
});

Route::group(['prefix'=>'articles/{article}'],function(){
    Route::post('support','ArticlesController@support');
    Route::post('unsupport','ArticlesController@unsupport');

});



Route::resource('users','UsersController');

Route::resource('collects','CollectsController',['only'=>['store','destroy']]);

Route::resource('likeables','LikeablesController',['only'=>['store','destroy']]);

Route::resource('comments','CommentsController',['only'=>['store','update']]);

Route::get('/home', 'HomeController@index');
Route::resource('/admin/users','admin\UsersController');
Route::resource('admin/categories','admin\CategoriesController');
//Route::resource('admin/professions','admin\ProfessionsController');
Route::get('admin/professions','admin\ProfessionsController@index');
Route::resource('admin/articles','admin\ArticlesController');

Route::group(['namespace' => 'admin'], function () {
    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
    Route::resource('articles','admin\ArticlesController');
});
Route::resource('articles','admin\ArticlesController');
Route::resource('admin/child_categories','admin\ChildCategoriesController',['only'=>['store','destroy','show']]);
Route::get('/','IndexController@index');
Route::resource('admin/professions','admin\ProfessionsController',['only'=>['store','destroy','show']]);

Auth::routes();


