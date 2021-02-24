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


//the routes the whole public can access
Route::get('/','PagesController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('public/post/{id}', 'PagesController@post')->name('post');

Route::resource('admin/comments','PostCommentsController');

Route::get('/delete/comment/{id}','PostCommentsController@destroy');




//the routes a user can access if he is logged in and is admin and the status is active
Route::group(['middleware'=>'admin'],function(){


        Route::get('/admin',function(){
            return view('admin.index');
        })->name('adminIndex');




        Route::resource('admin/users','AdminUsersController');

        Route::get('/user/{id}/edit','AdminUsersController@edit');

        Route::post('/user/update/{id}','AdminUsersController@update');

        Route::get('/user/delete/{id}','AdminUsersController@destroy')->name('deleteUser');




        Route::resource('admin/posts','AdminPostsController');

        Route::get('/admin/posts/{id}/edit','AdminPostsController@edit');

        Route::post('/admin/posts/update/{id}','AdminPostsController@update');

        Route::get('/post/delete/{id}','AdminPostsController@destroy')->name('deletePost');




        Route::resource('admin/categories','AdminCategoriesController');

        Route::get('categories/edit/{id}','AdminCategoriesController@edit')->name('editCategory');

        Route::get('categories/delete/{id}','AdminCategoriesController@destroy')->name('deleteCategory');

        Route::post('categories/update/{id}','AdminCategoriesController@update')->name('updateCategory');






        Route::resource('admin/comment/replies','CommentRepliesController');


});




//the routes a user can access only if he is logged in
Route::group(['middleware'=>'userloggedin'],function(){

    Route::resource('users/public','PublicController');

    Route::post('/user/public/update/{id}','PublicController@update');

    Route::get('/user/public/delete/{id}','PublicController@destroy')->name('deletePublicUser');


});
















