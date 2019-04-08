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



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/partneri', 'HomeController@partneri')->name('partneri');
Route::get('/amp/apartmani-igalo', 'HomeController@partneri')->name('partneri');

Route::get('/create','ProductController@create')->middleware('auth');
Route::get('/edit/{id}','ProductController@edit')->middleware('auth');
Route::post('/create','ProductController@store')->middleware('auth');
Route::post('/update/{id}','ProductController@update')->middleware('auth');
Route::post('/image-upload','ImageController@store')->middleware('auth');
Route::post('/image-delete','ImageController@destroy')->middleware('auth');

Route::get('/inbox', 'ChatController@index')->middleware('auth')->name('inbox');
Route::get('/chat/{id}', 'ChatController@show')->middleware('auth');
Route::post('/chat/send', 'ChatController@store')->middleware('auth');

Route::get('/profil/user/{id}','ProductController@userProfile')->name('profil-user');
Route::get('/admin/user/','ProductController@userAdmin')->middleware('auth')->name('admin-user');
Route::get('/admin/product/delete/{id}','ProductController@destroy')->middleware('auth');

Route::get('/magazin/new', 'MagazineController@create')->middleware('admin');
Route::post('/magazin/store', 'MagazineController@store')->middleware('admin');
Route::get('/magazin', 'MagazineController@index')->name('magazin');
Route::get('/magazin/edit/{id}', 'MagazineController@edit')->middleware('admin');
Route::post('/magazin/update/{id}', 'MagazineController@update')->middleware('admin');
Route::get('/magazin/{cat_name}', 'MagazineController@category');
Route::get('/magazin/{id}/{slug?}', 'MagazineController@show');
Route::get('/magazin/amp/{id}/{slug?}', 'MagazineController@ampshow');


Route::post('/vote', 'RatingController@store');
Route::get("/uslovi", 'ProductController@uslovi');
Route::get("/about", 'ProductController@about');
// SITEMAP SITEMAP SITEMAP SITEMAP SITEMAP
Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/magazin', 'SitemapController@magazin');

Route::get('/sitemap/kategorije', 'SitemapController@categories');
Route::get('/sitemap/magazin/kategorije', 'SitemapController@magazinCategories');

Route::get('/sitemap/{cat_sitemap}', 'SitemapController@products');
Route::get('/sitemap/magazin/{cat_sitemap}', 'SitemapController@magazinArticles');

Route::get('/oglas/{slug}/{id}','ProductController@show');
Route::get('/subcategories/{id}','SubCategoryController@index');
Route::get('/{category_name?}','ProductController@search');

