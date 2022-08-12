<?php

use Illuminate\Support\Facades\Route;
use App\Exchange;
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

/*Route::get('/time', function () {
    return date('Y-m-d h:i:s');
});*/

Route::post('/dashboard/uploadImg', 'Admin\EditorController@UploadImg')->name('dashboard.upload');

Route::get('/dashboard/browse', 'Admin\EditorController@fileBrowse')->name('dashboard.browse');


Route::get('/error', function () {
    return view('site.deactive');
})->name('error');
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFace');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFace');

Auth::routes();
### DASHBOARD PAGES#############
Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard/country', 'Admin\DashBoardController@country')->name('dashboard.country');
Route::get('dashboard/settings', 'Admin\DashBoardController@settings')->name('dashboard.settings');
Route::get('dashboard/users', 'Admin\DashBoardController@users')->name('dashboard.users');
Route::get('dashboard/info', 'Admin\DashBoardController@info')->name('dashboard.info');
Route::get('dashboard/category', 'Admin\DashBoardController@category')->name('dashboard.category');
Route::get('dashboard/subcategory', 'Admin\DashBoardController@subcategory')->name('dashboard.subcategory');
Route::get('dashboard/categoryQuiz', 'Admin\DashBoardController@categoryQuiz')->name('dashboard.categoryQuiz');
Route::get('dashboard/{id}/askQuiz', 'Admin\DashBoardController@askQuiz')->name('dashboard.askQuiz');
Route::get('dashboard/{id}/answerQuiz', 'Admin\DashBoardController@answerQuiz')->name('dashboard.answerQuiz');
Route::get('dashboard/posts', 'Admin\DashBoardController@posts')->name('dashboard.posts');
Route::get('dashboard/posts/create', 'Admin\DashBoardController@createPost')->name('dashboard.createPost');
Route::get('dashboard/units', 'Admin\DashBoardController@units')->name('dashboard.units');
Route::get('dashboard/currancies', 'Admin\DashBoardController@currancies')->name('dashboard.currancies');
Route::get('dashboard/materials', 'Admin\DashBoardController@materials')->name('dashboard.materials');
Route::get('dashboard/materialexchange', 'Admin\DashBoardController@materialExchange')->name('dashboard.material.exchange');
Route::get('dashboard/exchange', 'Admin\DashBoardController@exchange')->name('dashboard.exchange');
Route::get('dashboard/tags', 'Admin\DashBoardController@tags')->name('dashboard.tags');
Route::get('dashboard/systems', 'Admin\DashBoardController@systems')->name('dashboard.systems');
Route::get('dashboard/weather', 'Admin\DashBoardController@weather')->name('dashboard.weathers');
Route::get('dashboard/messages', 'Admin\DashBoardController@messages')->name('dashboard.messages');
Route::get('dashboard/abouts', 'Admin\DashBoardController@about')->name('dashboard.abouts');
Route::get('dashboard/departs', 'Admin\DashBoardController@departs')->name('dashboard.departs');
Route::get('dashboard/departs_second', 'Admin\DashBoardController@departs_second')->name('dashboard.departs_second');
Route::get('dashboard/add_depart_second', 'Admin\DashBoardController@add_depart_second')->name('dashboard.add_depart_second');
Route::post('dashboard/add_depart_second', 'Admin\DepartController@store_depart_second');
Route::post('dashboard/{id}/update_depart_second', 'Admin\DepartController@update_depart_second');
Route::get('dashboard/analize', 'Admin\DashBoardController@analize')->name('dashboard.analize');
Route::get('dashboard/posts/{post}/edit', 'Admin\PostController@edit')->name('dashboard.post.edit');
Route::get('dashboard/posts/{post}/region', 'Admin\DashBoardController@posts_region')->name('dashboard.posts.region');
Route::get('dashboard/posts/{post}/getregion', 'Admin\PostController@getPostsByRId')->name('dashboard.posts.getregion');


Route::get('dashboard/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('dashboard.logout')->middleware('auth');


##### SITE PAGES ###########
########SETTINGS
Route::get('/dashboard/settings/get', 'Admin\SettingController@getAll')->name('dashboard.settings.get');
Route::post('/dashboard/settings/save', 'Admin\SettingController@save')->name('dashboard.settings.save');

########Info
Route::get('/dashboard/info/get', 'Admin\InfoController@getAll')->name('dashboard.info.get');
Route::get('/dashboard/info/{id}/get', 'Admin\InfoController@show')->name('dashboard.info.get.one');
Route::delete('/dashboard/info/{id}/delete', 'Admin\InfoController@delete')->name('dashboard.info.delete.one');
Route::post('/dashboard/info/save', 'Admin\InfoController@store')->name('dashboard.info.save');
Route::put('/dashboard/info/update', 'Admin\InfoController@update')->name('dashboard.info.update');
Route::get('/dashboard/info/get/all', 'Admin\InfoController@all')->name('dashboard.info.get.all');
Route::post('/dashboard/info_time/update', 'Admin\InfoController@info_timeupdate')->name('dashboard.info.info_timeupdate');


##########USERS
Route::get('/dashboard/users/all', 'Admin\UserController@getAll')->name('dashboard.users.get');
Route::get('/dashboard/users/{id}/active', 'Admin\UserController@active')->name('dashboard.users.active');
Route::get('/dashboard/users/{id}/edit', 'Admin\UserController@edit')->name('dashboard.users.edit');
Route::get('/dashboard/users/{id}/getOne', 'Admin\UserController@getOne')->name('dashboard.users.getOne');
Route::put('/dashboard/users/{id}/update', 'Admin\UserController@update')->name('dashboard.users.update');
Route::delete('/dashboard/users/{id}/delete', 'Admin\UserController@delete')->name('dashboard.users.delete');





########Country
Route::get('/dashboard/countries/get', 'Admin\CountryController@getAll')->name('dashboard.country.get');
Route::get('/dashboard/countries/{id}/get', 'Admin\CountryController@show')->name('dashboard.country.get.one');
Route::get('/dashboard/countries/{id}/delete', 'Admin\CountryController@delete')->name('dashboard.country.delete.one');
Route::post('/dashboard/countries/save', 'Admin\CountryController@store')->name('dashboard.country.save');
Route::post('/dashboard/countries/update', 'Admin\CountryController@update')->name('dashboard.country.update');
Route::get('/dashboard/countries/get/all', 'Admin\CountryController@all')->name('dashboard.country.get.all');
######## City #######
Route::get('/dashboard/cities/get', 'Admin\CityController@getAll')->name('dashboard.city.get');
Route::get('/dashboard/cities/{id}/get', 'Admin\CityController@show')->name('dashboard.city.get.one');
Route::get('/dashboard/cities/{id}/delete', 'Admin\CityController@delete')->name('dashboard.city.delete.one');
Route::get('/dashboard/cities/{id}/edit', 'Admin\CityController@edit')->name('dashboard.city.edit.one');
Route::post('/dashboard/cities/save', 'Admin\CityController@store')->name('dashboard.city.save');
Route::put('/dashboard/cities/update', 'Admin\CityController@update')->name('dashboard.city.update');
Route::get('/dashboard/cities/get/all', 'Admin\CityController@all')->name('dashboard.city.get.all');
Route::get('/dashboard/cities/get/all', 'Admin\CityController@all')->name('dashboard.city.get.all');
Route::get('/dashboard/country/city/{id}/all', 'Admin\CityController@getCityByCountry')->name('dashboard.country.city.get.all');
Route::get('/dashboard/cities/addcity', 'Admin\CityController@addcity')->name('dashboard.city.addcity');
Route::post('/dashboard/cities/addcity_form', 'Admin\CityController@addcity_form')->name('dashboard.city.addcity_form');
Route::post('/dashboard/cities/editcity_form', 'Admin\CityController@editcity_form')->name('dashboard.city.editcity_form');


######## Region #######
Route::get('/dashboard/regions/get', 'Admin\RegionController@getAll')->name('dashboard.region.get');
Route::get('/dashboard/regions/{id}/get', 'Admin\RegionController@show')->name('dashboard.region.get.one');
Route::delete('/dashboard/regions/{id}/delete', 'Admin\RegionController@delete')->name('dashboard.region.delete.one');
Route::get('/dashboard/regions/{id}/edit', 'Admin\RegionController@edit')->name('dashboard.region.delete.one');
Route::post('/dashboard/regions/save', 'Admin\RegionController@store')->name('dashboard.region.save');
Route::post('/dashboard/regions/update', 'Admin\RegionController@update')->name('dashboard.region.update');
Route::get('/dashboard/regions/get/all', 'Admin\RegionController@all')->name('dashboard.region.get.all');
Route::get('/dashboard/city/region/{id}/all', 'Admin\RegionController@getRegionByCity')->name('dashboard.city.region.get.all');
Route::get('/dashboard/city/region/{id}/all_list', 'Admin\RegionController@getRegionByCity_list')->name('dashboard.city.region.get.all');
Route::get('/dashboard/{id}/region', 'Admin\RegionController@getRegionByCity')->name('dashboard.city.region');



#######Category
Route::get('/dashboard/categories/get', 'Admin\CategoryController@getAll')->name('dashboard.category.get');
Route::get('/dashboard/categories/{id}/get', 'Admin\CategoryController@show')->name('dashboard.category.get.one');
Route::delete('/dashboard/categories/{id}/delete', 'Admin\CategoryController@delete')->name('dashboard.category.delete.one');
Route::post('/dashboard/categories/save', 'Admin\CategoryController@store')->name('dashboard.category.save');
Route::put('/dashboard/categories/update', 'Admin\CategoryController@update')->name('dashboard.category.update');
Route::get('/dashboard/categories/get/all', 'Admin\CategoryController@all')->name('dashboard.category.get.all');


#######SubCategory
Route::get('/dashboard/subcategories/get', 'Admin\SubCatController@getAll')->name('dashboard.subcategory.get');
Route::get('/dashboard/subcategories/{id}/get', 'Admin\SubCatController@show')->name('dashboard.subcategory.get.one');
Route::delete('/dashboard/subcategories/{id}/delete', 'Admin\SubCatController@delete')->name('dashboard.subcategory.delete.one');
Route::post('/dashboard/subcategories/save', 'Admin\SubCatController@store')->name('dashboard.subcategory.save');
Route::put('/dashboard/subcategories/update', 'Admin\SubCatController@update')->name('dashboard.subcategory.update');
Route::get('/dashboard/subcategories/get/all', 'Admin\SubCatController@all')->name('dashboard.subcategory.get.all');
Route::get('/dashboard/subcategories/{cat}/fromCat', 'Admin\SubCatController@fromCat')->name('dashboard.subcategory.get.fromCat');


#######CategoryQuizz
Route::get('/dashboard/categoriesQuiz/get', 'Admin\CategoryQuizController@getAll')->name('dashboard.categoryQuiz.get');
Route::get('/dashboard/categoriesQuiz/{id}/get', 'Admin\CategoryQuizController@show')->name('dashboard.categoryQuiz.get.one');
Route::get('/dashboard/categoriesQuiz/{id}/delete', 'Admin\CategoryQuizController@delete')->name('dashboard.categoryQuiz.delete.one');
Route::get('/dashboard/categoriesQuiz/{id}/editquiz', 'Admin\CategoryQuizController@editquiz')->name('dashboard.categoryQuiz.editquiz.one');
Route::post('/dashboard/categoriesQuiz/save', 'Admin\CategoryQuizController@store')->name('dashboard.categoryQuiz.save');
Route::post('/dashboard/categoriesQuiz/update', 'Admin\CategoryQuizController@update')->name('dashboard.categoryQuiz.update');
Route::get('/dashboard/categoriesQuiz/get/all', 'Admin\CategoryQuizController@all')->name('dashboard.categoryQuiz.get.all');

#######AskQuizz
Route::get('/dashboard/asksQuiz/get', 'Admin\AskQuizController@getAll')->name('dashboard.asksQuiz.get');
Route::get('/dashboard/asksQuiz/{id}/get', 'Admin\AskQuizController@show')->name('dashboard.asksQuiz.get.one');
Route::get('/dashboard/asksQuiz/{id}/delete', 'Admin\AskQuizController@delete')->name('dashboard.asksQuiz.delete.one');
Route::get('/dashboard/asksQuiz/{id}/editask', 'Admin\AskQuizController@editask')->name('dashboard.asksQuiz.editask.one');
Route::post('/dashboard/asksQuiz/save', 'Admin\AskQuizController@store')->name('dashboard.asksQuiz.save');
Route::post('/dashboard/asksQuiz/update', 'Admin\AskQuizController@update')->name('dashboard.asksQuiz.update');
Route::get('/dashboard/asksQuiz/get/all', 'Admin\AskQuizController@all')->name('dashboard.asksQuiz.get.all');

#######AnswerQuizz
Route::get('/dashboard/answersQuiz/get', 'Admin\AnswerQuizController@getAll')->name('dashboard.answersQuiz.get');
Route::get('/dashboard/answersQuiz/{id}/get', 'Admin\AnswerQuizController@show')->name('dashboard.answersQuiz.get.one');
Route::delete('/dashboard/answersQuiz/{id}/delete', 'Admin\AnswerQuizController@delete')->name('dashboard.answersQuiz.delete.one');
Route::post('/dashboard/answersQuiz/save', 'Admin\AnswerQuizController@store')->name('dashboard.answersQuiz.save');
Route::put('/dashboard/answersQuiz/update', 'Admin\AnswerQuizController@update')->name('dashboard.answersQuiz.update');
Route::get('/dashboard/answersQuiz/get/all', 'Admin\AnswerQuizController@all')->name('dashboard.answersQuiz.get.all');

######### Messages Route
Route::get('dashboard/messages/get', 'Admin\MessageController@getAll')->name('dashboard.message.get.all');
Route::post('dashboard/messages/replay', 'Admin\MessageController@replay')->name('dashboard.message.replay');
Route::post('/dashboard/messages/{id}/readchange', 'Admin\MessageController@read')->name('dashboard.message.read');
Route::delete('/dashboard/messages/{id}/delete', 'Admin\MessageController@delete')->name('dashboard.message.delete');
Route::get('/dashboard/messages/getByUserId/{id}', 'Admin\MessageController@getMessagesByUserId')->name('dashboard.message.getByUserId');

#######Unit
Route::get('/dashboard/units/get', 'Admin\UnitController@getAll')->name('dashboard.unit.get');
Route::get('/dashboard/units/{id}/get', 'Admin\UnitController@show')->name('dashboard.unit.get.one');
Route::delete('/dashboard/units/{id}/delete', 'Admin\UnitController@delete')->name('dashboard.unit.delete.one');
Route::post('/dashboard/units/save', 'Admin\UnitController@store')->name('dashboard.unit.save');
Route::put('/dashboard/units/update', 'Admin\UnitController@update')->name('dashboard.unit.update');
Route::get('/dashboard/units/get/all', 'Admin\UnitController@all')->name('dashboard.unit.get.all');


#######Curancy
Route::get('/dashboard/currancies/get', 'Admin\CurrancyController@getAll')->name('dashboard.currancy.get');
Route::get('/dashboard/currancies/{id}/get', 'Admin\CurrancyController@show')->name('dashboard.currancy.get.one');
Route::delete('/dashboard/currancies/{id}/delete', 'Admin\CurrancyController@delete')->name('dashboard.currancy.delete.one');
Route::post('/dashboard/currancies/save', 'Admin\CurrancyController@store')->name('dashboard.currancy.save');
Route::put('/dashboard/currancies/update', 'Admin\CurrancyController@update')->name('dashboard.currancy.update');
Route::get('/dashboard/currancies/get/all', 'Admin\CurrancyController@all')->name('dashboard.currancy.get.all');
Route::get('/dashboard/currancies/get/active', 'Admin\CurrancyController@get_active')->name('dashboard.currancy.get.active');
#######Exchange
Route::post('/dashboard/exchange/save', 'Admin\ExchangeController@save')->name('exchange.save');
Route::get('/dashboard/exchange/get', 'Admin\ExchangeController@get')->name('exchange.get');
Route::delete('/dashboard/exchange/{id}/delete', 'Admin\ExchangeController@delete')->name('exchange.delete');
Route::get('/dashboard/exchange/{id}/edit', 'Admin\ExchangeController@edit')->name('exchange.edit');
Route::put('/dashboard/exchange/{id}/update', 'Admin\ExchangeController@update')->name('exchange.update');
Route::get('/dashboard/exchange/{id}/getExchange', 'Admin\ExchangeController@getExchange')->name('exchange.getExchange');
Route::get('dashboard/ex/title', 'Admin\ExchangeController@getTitle')->name('dashboard.getTitle');
Route::get('dashboard/ex/title/show', 'Admin\ExchangeController@showTitle')->name('dashboard.showTitle');
Route::get('dashboard/ex/editTablesTitle', 'Admin\ExchangeController@editTablesTitle')->name('dashboard.editTablesTitle');
Route::post('dashboard/ex/updateTablesTitle', 'Admin\ExchangeController@updateTablesTitle')->name('dashboard.updateTablesTitle');
Route::post('dashboard/ex/title', 'Admin\ExchangeController@saveTitle')->name('dashboard.svaeTitle');

#######Materials
Route::get('/dashboard/materials/get', 'Admin\MaterialController@getAll')->name('dashboard.material.get');
Route::get('/dashboard/materials/{id}/get', 'Admin\MaterialController@show')->name('dashboard.material.get.one');
Route::delete('/dashboard/materials/{id}/delete', 'Admin\MaterialController@delete')->name('dashboard.material.delete.one');
Route::post('/dashboard/materials/save', 'Admin\MaterialController@store')->name('dashboard.material.save');
Route::put('/dashboard/materials/update', 'Admin\MaterialController@update')->name('dashboard.material.update');
Route::get('/dashboard/materials/get/all', 'Admin\MaterialController@all')->name('dashboard.material.get.all');

Route::post('/dashboard/materialExchange/save', 'Admin\MaterialExchangeController@save')->name('material.exchange.save');
Route::post('/dashboard/materialExchange/{id}/update', 'Admin\MaterialExchangeController@update')->name('material.exchange.update');
Route::get('/dashboard/materialExchange/get', 'Admin\MaterialExchangeController@get')->name('material.exchange.get');
Route::get('/dashboard/matEx/{id}/get', 'Admin\MaterialExchangeController@MatEx')->name('MatEx.get');
Route::get('/dashboard/matEx/{id}/edit', 'Admin\MaterialExchangeController@edit')->name('MatEx.get');
Route::delete('/dashboard/MatEx/{id}/delete', 'Admin\MaterialExchangeController@delete')->name('MatEx.delete');

#######Posts
Route::get('/dashboard/posts/get', 'Admin\PostController@getAll')->name('dashboard.post.get');
Route::get('/dashboard/posts/{post}/get', 'Admin\PostController@show')->name('dashboard.post.get.one');
Route::delete('/dashboard/posts/{id}/delete', 'Admin\PostController@delete')->name('dashboard.post.delete.one');
Route::post('/dashboard/posts/save', 'Admin\PostController@store')->name('dashboard.post.save');
Route::put('/dashboard/posts/update', 'Admin\PostController@update')->name('dashboard.post.update');
Route::get('/dashboard/posts/get/all', 'Admin\PostController@all')->name('dashboard.post.get.all');
Route::put('/dashboard/post/{id}/active', 'Admin\PostController@active')->name('dashboard.post.active');
Route::put('/dashboard/posts/{post}/update', 'Admin\PostController@update')->name('dashboard.post.update');
Route::get('/dashboard/posts/activeAll', 'Admin\PostController@activeAll')->name('dashboard.post.activeAll');
Route::get('/dashboard/posts/getByUserId/{id}', 'Admin\PostController@getPostsByUserId')->name('dashboard.post.getByUserId');
Route::get('/dashboard/posts/getByRegion/{id}', 'Admin\PostController@getPostsByRegionId')->name('dashboard.post.getByRegion');

###### Comments
Route::get('/dashboard/comments/getByUserId/{id}', 'Admin\CommentController@getCommentsByUserId')->name('dashboard.comment.getByUserId');
Route::delete('/dashboard/comments/{id}/delete', 'Admin\CommentController@delete')->name('dashboard.comment.delete');


###### System
Route::post('dashboard/system/save', 'Admin\SystemController@save');
Route::get('dashboard/system/all', 'Admin\SystemController@all');
Route::get('dashboard/tips/all', 'Admin\SystemController@all_tips');
Route::get('/dashboard/system/{id}/edit', 'Admin\SystemController@edit');
Route::get('/dashboard/system/{id}/getOne', 'Admin\SystemController@getOne');
Route::post('/dashboard/system/{id}/update', 'Admin\SystemController@update');
Route::delete('/dashboard/system/{id}/delete', 'Admin\SystemController@delete');


#### Weather
Route::get('dashboard/weathers/get', 'Admin\WeatherController@getAll')->name('dahsboard.weather.get');
Route::get('dashboard/weathers/{id}/getWeather', 'Admin\WeatherController@getWeather')->name('dahsboard.weather.getWeather');
Route::get('dashboard/weathers/{id}/edit', 'Admin\WeatherController@edit')->name('dahsboard.weather.edit');
Route::put('dashboard/weathers/{id}/update', 'Admin\WeatherController@update')->name('dahsboard.weather.update');
Route::post('dashboard/weathers/save', 'Admin\WeatherController@save')->name('dahsboard.weather.save');
Route::delete('dashboard/weathers/{id}/delete', 'Admin\WeatherController@delete')->name('dahsboard.weather.delete');


############################### SITE ROUTES ############

############# AJAX ########## SITE########

Route::get('getCategories', 'Site\CategoryController@getCategories')->name('getCategory');
Route::get('getCities', 'Site\CityController@getCities')->name('getCities');
Route::get('getUnits', 'Site\UnitController@getUnits')->name('getUnits');
Route::get('getCurrancies', 'Site\CurrancyController@getCurrancies')->name('getCurrancies');
Route::get('getCurrancies/all', 'Site\CurrancyController@getAllCurrancies')->name('getAllCurrancies');
Route::get('getSpecialPost', 'Site\PostController@getSpecialPost')->name('getSpecialPost');
Route::get('getLatestPost', 'Site\PostController@getLatestPost')->name('getLatestPost');
Route::get('getAllPosts', 'Site\PostController@getAllPosts')->name('getAllPosts');
Route::post('sendMsg', 'Site\ContactUsController@sendMsg')->name('sendMsg');
Route::post('savePost', 'Site\PostController@save')->name('save.post');



#######Posts
Route::get('/dashboard/abouts/get', 'Admin\AboutController@getAll')->name('dashboard.about.get');
Route::get('/dashboard/abouts/create', 'Admin\AboutController@create')->name('dashboard.about.create');
Route::get('/dashboard/abouts/{post}/get', 'Admin\AboutController@show')->name('dashboard.about.get.one');
Route::get('/dashboard/abouts/{post}/edit', 'Admin\AboutController@edit')->name('dashboard.about.get.edit');
Route::delete('/dashboard/abouts/{id}/delete', 'Admin\AboutController@delete')->name('dashboard.about.delete.one');
Route::post('/dashboard/abouts/save', 'Admin\AboutController@store')->name('dashboard.about.save');
Route::put('/dashboard/abouts/{id}/update', 'Admin\AboutController@update')->name('dashboard.about.update');
Route::get('/dashboard/abouts/get/all', 'Admin\AboutController@all')->name('dashboard.about.get.all');
Route::put('/dashboard/abouts/{id}/active', 'Admin\AboutController@active')->name('dashboard.about.active');
Route::put('/dashboard/abouts/{post}/update', 'Admin\AboutController@update')->name('dashboard.about.update');


########## Depart Route

Route::get('/dashboard/departs/getAll', 'Admin\DepartController@getAll')->name('dashboard.departs.getAll');
Route::get('/dashboard/departs/{id}/edit', 'Admin\DepartController@edit')->name('dashboard.departs.edit');
Route::get('/dashboard/departs/{id}/delete', 'Admin\DepartController@delete')->name('dashboard.departs.delete');
Route::get('/dashboard/departs/{id}/get', 'Admin\DepartController@get')->name('dashboard.departs.get');
Route::put('/dashboard/departs/{id}/update', 'Admin\DepartController@update')->name('dashboard.departs.update');
Route::get('dashboard/departs/{id}/edit_depart_second', 'Admin\DepartController@edit_depart_second')->name('dashboard.departs.edit_depart_second');



########### analize
Route::get('dashboard/analize/all', 'Admin\AnalizeController@all')->name('dashboard.analize.all');
Route::get('dashboard/analize/create', 'Admin\AnalizeController@create')->name('dashboard.analize.create');
Route::post('dashboard/analize/store', 'Admin\AnalizeController@store')->name('dashboard.analize.store');
Route::get('dashboard/analize/{id}/edit', 'Admin\AnalizeController@edit')->name('dashboard.analize.edit');
Route::get('dashboard/analize/{id}/get', 'Admin\AnalizeController@getOne')->name('dashboard.analize.getOne');
Route::put('dashboard/analize/{id}/update', 'Admin\AnalizeController@update')->name('dashboard.analize.update');
Route::delete('dashboard/analize/{id}/delete', 'Admin\AnalizeController@delete')->name('dashboard.analize.delete');



Route::get('dashboard/clims', 'Admin\ClimController@index')->name('dashboard.clim.all');
Route::get('dashboard/clims/{id}/delete', 'Admin\ClimController@delete')->name('dashboard.clims.delete');
Route::get('dashboard/clims/{id}/read', 'Admin\ClimController@read')->name('dashboard.clims.read');

Route::get('/get_default_img', 'Site\PostController@get_default_img')->name('site.get_default_img');


Route::get('/test', function () {
});

########################################

Route::get('/', 'Site\MainController@index');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('getWeather/{city?}', 'Site\WeatherController@getWeather')->name('get.weather');
Route::get('getExchange', 'Site\ExchangeController@getExchange')->name('get.exchange');
Route::get('addPost', 'Site\PostController@addPost')->name('add.post')->middleware('auth');
Route::get('posts', 'Site\PostController@posts')->name('get.post');
Route::get('posts_adv', 'Site\PostController@postsAdvanced')->name('get.post_adv');
Route::get('departs', 'Site\DepartController@getAll')->name('departs.getAll');
Route::get('depart/{id}', 'Site\DepartController@getdep')->name('depart.getdep');
Route::get('quizeCat', 'Site\QuizController@category')->name('quize.quizeCat');
Route::get('quizz/{id}', 'Site\QuizController@quizz')->name('quize.quizz');
Route::get('quizz/{id}/asks', 'Site\QuizController@asks')->name('quize.asks');
Route::get('aboutIraq', 'Site\AboutIraqController@index')->name('about.iraq');
Route::get('getAbouts', 'Site\AboutIraqController@getAbouts')->name('about.getAbouts');
Route::get('getAbouts', 'Site\AboutIraqController@getAbouts')->name('about.getAbouts');
Route::post('answers/{id}/getanswers', 'Site\QuizController@getanswers')->name('quize.getanswers');
Route::get('posts/view', 'Site\PostController@getAllPosts')->name('post.view');
Route::get('spicial_posts/view', 'Site\PostController@getAllSpicialPosts')->name('post.view');
Route::get('post/{id}/show', 'Site\PostController@show')->name('post.show');
Route::post('/Comments/save', 'Site\CommentController@store')->name('comment.store');
Route::get('/comments/{id}/get', 'Site\CommentController@getAll')->name('comment.get');
Route::get('/System/{type?}', 'Site\SystemController@index')->name('system.index');
Route::get('/tips', 'Site\SystemController@tips')->name('system.tips');
Route::get('/tips/{id}/show', 'Site\SystemController@show_tips')->name('system.show_tips');
Route::get('getSystem', 'Site\SystemController@getAbouts')->name('system.get');
Route::get('getTip', 'Site\SystemController@getTip')->name('system.get.tip');
Route::get('Info', 'Site\InfoController@getInfo')->name('Info.get');
Route::get('note/all', 'Site\InfoController@all')->name('Info.all');
Route::get('aboutUs', 'Site\MainController@about')->name('about');
Route::get('sitemap', 'Site\MainController@sitemap')->name('sitemap');
Route::get('Privacy', 'Site\MainController@privacy')->name('privacy');
Route::get('terms', 'Site\MainController@terms')->name('terms');
Route::get('search', 'Site\PostController@search')->name('search');
Route::get('profile', 'Site\ProfileController@edit')->name('profile.edit');
Route::get('anylize', 'Site\AnlyzeController@index')->name('anylize');
Route::get('exchange', 'Site\ExchangeController@index')->name('exchange');
Route::post('profile', 'Site\ProfileController@store')->name('profile.update');
Route::get('post/{id}/edit', 'Site\ProfileController@editPost')->name('post.edit');
Route::get('post/{id}/get', 'Site\ProfileController@getPost')->name('post.get');
Route::get('posts/{id}/user', 'Site\PostController@getPostByUser')->name('post.get.ByUser');
Route::post('post/{id}/update', 'Site\ProfileController@update')->name('post.update');
Route::get('post/{id}/delete', 'Site\ProfileController@delete')->name('post.delete');
Route::get('favorit/{id}/store', 'Site\FavoritController@save')->name('fav.save');
Route::get('favorit/{id}/delete', 'Site\FavoritController@delete')->name('fav.delete');
Route::post('chat/{id}/send', 'Site\ChatController@store')->name('send.msg');
Route::get('chat/all/messages', 'Site\ChatController@AllMsg')->name('msg.all');
Route::get('message/{send}/{post_id}', 'Site\ChatController@getMsgs')->name('msg.show');
Route::post('message/{send}/{post}', 'Site\ChatController@replay')->name('msg.replay');
Route::post('message/clim', 'Site\ClimController@store')->name('send.clim');
Route::get('/subcategories/{cat}/fromCat', 'Site\CategoryController@fromCat')->name('subcategory.get.fromCat');
Route::get('/subcategories/{id}/get', 'Site\CategoryController@show')->name('subcategory.get.one');
Route::get('/city/region/{id}/all_list', 'Site\CityController@getRegionByCity_list')->name('city.region.get.all');

Route::get('/contactus', function () {
    return view('site.contact_us');
});

Route::get('signOut', function () {
    if (auth()->check()) {
        auth()->logout();
    }
    return redirect('/');
})->name('SignOut');

Route::get('/getSubCategories', 'Site\CategoryController@getSubCategories')->name('getSubCats');

Route::get('export', 'ImportExportController@export')->name('export');
Route::get('importExportView', 'ImportExportController@importExportView');
Route::get('postexport', 'ImportExportController@postexport')->name('postexport');


Route::get('/fortest', function () {
    return "";
});

/////api
Route::post('allposts_api', 'Site\PostController@getAllPosts_api');
Route::get('delete_all', 'Admin\ClimController@delet_all')->name('postexport');

//Firebase
Route::get('firebase-test', 'Site\FirebaseController@getPage')->name('get.page');
