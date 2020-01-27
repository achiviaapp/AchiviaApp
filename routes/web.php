<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/join-to-us', 'HomeController@welCome');
Route::get('api/mobile-data', 'HomeController@mobData');
Route::post('client-landing-page', 'HomeController@landingStore');
Auth::routes();

Route::get('/login', function(){
    abort(404);
});

Route::get('/axiepanel', 'Auth\LoginController@showLoginForm')->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::middleware(['admin'])->group(function () {
        /**
         * sending routes
         */
        Route::get('sending', 'SendingController@index');
        Route::get('sending-create', 'SendingController@create');
        Route::post('sending-store', 'SendingController@store');
        Route::get('sending-edit/{id}', 'SendingController@edit');
        Route::post('sending-update', 'SendingController@update');
        Route::get('sms/get_data', 'SendingController@getAllData');

        /**
         * client actions routes
         */

        Route::get('new-requests', 'ClientActionController@newRequests');
        Route::get('client/get_new_requests_data', 'ClientActionController@getNewRequestsData');
        Route::get('/assign-user', 'ClientActionController@assignUser');

        /**
         * action routes
         */
        Route::get('actions', 'ActionController@index');
        Route::get('action-create', 'ActionController@create');
        Route::post('action-store', 'ActionController@store');
        Route::get('action-edit', 'ActionController@edit');
        Route::patch('action-update/{id}', 'ActionController@update');
        Route::delete('action-delete/{id}', 'ActionController@destroy');

        /**
         * project routes
         */
        Route::get('projects', 'ProjectController@index');
        Route::get('project-create', 'ProjectController@create');
        Route::post('project-store', 'ProjectController@store');
        Route::get('project-edit', 'ProjectController@edit');
        Route::patch('project-update/{id}', 'ProjectController@update');
        Route::delete('project-delete/{id}', 'ProjectController@destroy');
        Route::get('api/dropdown/cities', 'ProjectController@dropDownCity');
        Route::get('project/get_data', 'ProjectController@getAllData');
        Route::get('api/dropdown/project_teams', 'ProjectController@dropDownTeams');
        Route::get('project-custom', 'ProjectController@createCustom');
        Route::post('project-custom-store', 'ProjectController@storeCustom');

        /**
         * city routes
         */
        Route::get('cities', 'ProjectCityController@index');
        Route::get('city-create', 'ProjectCityController@create');
        Route::post('city-store', 'ProjectCityController@store');
        Route::get('city-edit', 'ProjectCityController@edit');
        Route::patch('city-update/{id}', 'ProjectCityController@update');
        Route::delete('city-delete/{id}', 'ProjectCityController@destroy');

        /**
         * method routes
         */
        Route::get('methods', 'MethodController@index');
        Route::get('method-create', 'MethodController@create');
        Route::post('method-store', 'MethodController@store');
        Route::get('method-edit', 'MethodController@edit');
        Route::patch('method-update/{id}', 'MethodController@update');
        Route::delete('method-delete/{id}', 'MethodController@destroy');

        /**
         * team routes
         */
        Route::get('teams', 'TeamController@index');
        Route::get('team-create', 'TeamController@create');
        Route::post('team-store', 'TeamController@store');
        Route::get('team-edit', 'TeamController@edit');
        Route::patch('team-update/{id}', 'TeamController@update');
        Route::delete('team-delete/{id}', 'TeamController@destroy');
        Route::get('team/get_data', 'TeamController@getAllData');


        /**
         * user routes
         */
        Route::get('users', 'UserController@index');
        Route::get('user-create', 'UserController@create');
        Route::post('user-store', 'UserController@store');
        Route::get('user-edit/{id}', 'UserController@edit');
        Route::post('user-update', 'UserController@update');
        Route::delete('user-delete/{id}', 'UserController@destroy');
        Route::get('users/get_data', 'UserController@getAllData');
        Route::get('api/dropdown/teams', 'UserController@dropDownTeams');


        /**
         * reports routes
         */
        Route::get('team-report/{id}', 'ReportController@teamReport');
        Route::get('sale-man-report/{id}', 'ReportController@saleManReport');
        Route::get('all-reports', 'ReportController@AllReports');
    });

    Route::middleware(['notClient'])->group(function () {

        /**
         *
         * client routes
         */
        Route::get('clients', 'ClientController@index');
        Route::get('api/dropdown', 'ClientController@dropDown');
        Route::get('api/dropdown/sales', 'ClientController@dropDownSale');
        Route::get('api/dropdown/marketer', 'ClientController@dropDownMarketer');
        Route::get('client-create', 'ClientController@create');
        Route::post('client-store', 'ClientController@store');
        Route::get('client-quick-create', 'ClientController@quickCreate');
        Route::post('client-quick-store', 'ClientController@quickStore');
        Route::get('client-upload-view', 'ClientController@uploadView');
        Route::post('client-upload', 'ClientController@upload');
        Route::get('client-edit/{id}', 'ClientController@edit');
        Route::post('client-update', 'ClientController@update');
        Route::post('client-form-update', 'ClientController@updateForm');
        Route::delete('client-delete', 'ClientController@destroy');
        Route::get('client-profile/{id}', 'ClientController@profile');
        Route::get('client/get-profile-data/{id}', 'ClientController@getProfileData');

        /**
         * client actions routes
         */
        Route::get('all-clients', 'ClientActionController@allClients');
        Route::get('client/get_all_data', 'ClientActionController@getAllData');
        Route::get('new-clients', 'ClientActionController@newClients');
        Route::get('client/get_data/{id}', 'ClientActionController@getData');
        Route::get('action-client/{id}', 'ClientActionController@actionClient');
        Route::get('/client/get_todo_data', 'ClientActionController@getToDoData');
        Route::get('todo-data', 'ClientActionController@toDoClients');
        Route::get('client/get_todo_hot_data', 'ClientActionController@getToDoHotData');
        Route::get('todo-hot-data', 'ClientActionController@toDoHotClients');
        Route::get('history-clients/{id}', 'ClientActionController@history');
        Route::get('client/get_history/{id}', 'ClientActionController@getHistory');
        Route::get('duplicated-clients', 'ClientActionController@duplicated');
        Route::get('client/get_duplicated_data', 'ClientActionController@getDuplicatedData');
        Route::get('transfered-clients', 'ClientActionController@transfered');
        Route::get('client/get_transfered_data', 'ClientActionController@getTransferedData');
        Route::get('client/load-history', 'ClientActionController@loadHistory');

    });
});
