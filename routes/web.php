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

Route::get('/', function(){

    return redirect('dashboard');
});

Route::group(['prefix' => '/'],function(){

    Route::resource('dashboard', 'Administrator\DashboardController');
    Route::resource('add_menu', 'Administrator\Add_menuController');
    Route::resource('add_subs_menu', 'Administrator\Add_subs_menuController');
    Route::resource('add_user_role', 'Administrator\Add_user_roleController');
    Route::resource('add_user_permission','Administrator\Add_user_permissionController');
    Route::resource('add_user', 'Administrator\Add_userController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => '/'],function(){
    Route::resource('addDepertment', 'department\DepertmentController');
});
