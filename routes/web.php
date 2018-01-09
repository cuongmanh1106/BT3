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
Route::get('/abc',function(){
		echo "abc";
	});

Route::get('/', function () {
    return view('welcome');
});

Route::get('a',function(){
	echo "abc";
});

Route::get('/','HomeController@index');

Route::group(['prefix'=>'admin' , 'middleware'=>'Login'],function() {

	Route::group(['prefix'=>'product'],function(){
		Route::get('/','ProductController@index')->name('product.list');
		Route::post('/','ProductController@index')->name('product.list');
		Route::get('/create','ProductController@create')->name('product.create');
		Route::post('/store','ProductController@store')->name('product.insert')->middleware('CheckId');
		Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
		Route::post('/update/{id}','ProductController@update')->name('product.update')->middleware('CheckId');
		Route::get('/delete/{id}','ProductController@delete')->name('product.delete');

	});

	Route::group(['prefix'=>'categories'],function() {
		Route::get('/','CategoriesController@index')->name('categories.list');
		Route::get('/create','CategoriesController@create')->name('categories.create');
		Route::post('/store','CategoriesController@store')->name('categories.store');
		Route::get('/edit/{id}','CategoriesController@edit')->name('categories.edit');
		Route::post('/update/{id}','CategoriesController@update')->name('categories.update');
		Route::get('/delete/{id}','CategoriesController@delete')->name('categories.delete');
		Route::get('/list_pro/{id}','CategoriesController@list_pro')->name('categories.list_pro');

		
	});

	


});
Route::get('login', 'LoginController@getLogin')->name('login.get');
Route::post('login', 'LoginController@postLogin')->name('login.post');
Route::get('logout','LoginController@Logout')->name('logout');

Route::get('register', 'RegisterController@getRegister')->name('register.get');
Route::post('register', 'RegisterController@postRegister')->name('register.post');
//chuyen tat ca url k co ve trang 404
Route::any('{all?}','HomeController@notfound')->where('all','(.*)');

