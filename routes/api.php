<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Account System
Route::post('/login', 'Auth\LoginController@login_api');
Route::post('/is_login', 'Auth\LoginController@isLoggedIn_api');
Route::post('/facebook_login', 'Auth\LoginController@facebook_login_api');
Route::post('/register', 'Auth\RegisterController@create_api');
Route::get('/logout', 'Auth\LoginController@logout_api');

//Exchanges
Route::get('/exchange', 'Site\ExchangeController@apiIndex')->name('api.exchange');
Route::get('/excHeader', 'Site\ExchangeController@apiExcHeader')->name('api.excHeader');
Route::get('/localExchange', 'Site\ExchangeController@apiExc')->name('api.l_exchange');
Route::get('/openExchange', 'Site\ExchangeController@apiOpenExc')->name('api.o_exchange');

//Tips
Route::get('/tips', 'Site\SystemController@tips_api')->name('api.tips');
Route::get('/tips/{id}/get', 'Site\SystemController@showTip_api')->name('api.show_tip');

//Systems
Route::get('/systems', 'Site\SystemController@systems_api')->name('api.systems');

//Analysis
Route::get('/statistics', 'Site\AnlyzeController@index_api')->name('api.statistics');

//Posts
Route::post('allposts_api', 'Site\PostController@getAllPosts_api');
Route::post('get_my_posts_api', 'Site\PostController@get_my_posts_api');
Route::post('get_post_by_id', 'Site\PostController@get_post_by_id');
Route::post('get_default_post_image', 'Site\PostController@get_default_post_image_api');
Route::post('/posts_search', 'Site\PostController@postsSearch_api');
Route::post('/posts_search_adv', 'Site\PostController@postsAdvancedSearch_api');
Route::post('/save_post_api', 'Site\PostController@save_api');
Route::post('/update_post_api', 'Site\PostController@update_api');
Route::post('get_spical_posts_api', 'Site\PostController@get_spical_posts_api');
Route::post('get_all_spical_posts_api', 'Site\PostController@get_all_spical_posts_api');
Route::post('get_latest_posts_api', 'Site\PostController@get_latest_posts_api');
Route::post('/posts/delete', 'Site\PostController@delete_api');


//Users
Route::post('/users/update', 'Site\ProfileController@store_api');

//Quizz
Route::get('/quiz/category/all', 'Site\QuizController@category_api');
Route::get('answers/{id}/getanswers', 'Site\QuizController@getanswers');

//Cities
Route::get('cities/Baghdad/get_id', 'Site\CityController@getBaghdadId');

//Comments
Route::get('/posts/{id}/comments/all', 'Site\CommentController@getAllComments');
Route::post('/comments/save', 'Site\CommentController@storeComment');

//Favorites
Route::post('/users/favorit', 'Site\ProfileController@get_user_favorit_api');
Route::post('/favorites/delete', 'Site\FavoritController@delete_api');
Route::post('/favorites/add', 'Site\FavoritController@save_api');

//contact us
Route::post('/sendMsg_api', 'Site\ContactUsController@sendMsg_api')->name('sendMsg_api');

//pages
Route::get('pages_api', 'Site\AboutIraqController@getAbouts_api');
