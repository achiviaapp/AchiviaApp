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
Route::get('/landing_page/{link}', 'ProjectController@show');
Auth::routes();

Route::get('/login', function () {
    abort(404);
});

Route::get('/axiepanel', 'Auth\LoginController@showLoginForm')->name('login');

Route::middleware(['auth', 'isLimit', 'isExpire'])->group(function () {
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
         * settings routes
         */
        Route::get('settings', 'SettingController@index');
        Route::get('setting-edit/{id}', 'SettingController@edit');
        Route::post('setting-update', 'SettingController@update');
        Route::get('settings/get_data', 'SettingController@getAllData');

        /**
         * project routes
         */
        Route::get('projects', 'ProjectController@index');
        Route::get('project-create', 'ProjectController@create');
        Route::post('project-store', 'ProjectController@store');
        Route::get('project-edit/{id}', 'ProjectController@edit');
        Route::post('project-update', 'ProjectController@update');
        Route::delete('project-delete/{id}', 'ProjectController@destroy');
        Route::get('project/get_data', 'ProjectController@getAllData');
        Route::get('api/dropdown/project_teams', 'ProjectController@dropDownTeams');
        Route::get('add-sub-project', 'ProjectController@createSubProject');
        Route::post('sub-project-store', 'ProjectController@storeSubProject');
        Route::get('project-custom/{id}', 'ProjectController@createProjectDetail');
        Route::post('project-custom-store', 'ProjectController@storeProjectDetail');



        /**
         * team routes
         */
        Route::get('teams', 'TeamController@index');
        Route::get('team-create', 'TeamController@create');
        Route::post('team-store', 'TeamController@store');
        Route::get('team-edit/{id}', 'TeamController@edit');
        Route::post('team-update', 'TeamController@update');
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
        Route::post('user-delete', 'UserController@destroy');
        Route::get('sales-active', 'UserController@salesActive');
        Route::get('users/get_data', 'UserController@getAllData');
        Route::get('api/dropdown/teams', 'UserController@dropDownTeams');
        Route::get('api/dropdown/sales_team', 'UserController@salesTeam');

        /**
         * client actions routes
         */

        Route::get('new-requests', 'ClientActionController@newRequests');
        Route::get('client/get_new_requests_data', 'ClientActionController@getNewRequestsData');
        Route::get('assign-user', 'ClientActionController@assignUser');

    });
    Route::middleware(['leaveDecision'])->group(function () {
        /**
         * leaves routes
         */
        Route::post('leave-app/status', 'LeaveController@updateLeave');
    });
    Route::middleware(['notClient'])->group(function () {

        /**
         *
         * client routes
         */
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
        Route::get('api/dropdown/sales', 'ClientController@dropDownSale');
        Route::get('api/dropdown/marketer', 'ClientController@dropDownMarketer');


        /**
         * client actions routes
         */
        Route::get('client/all_client_action', 'ClientActionController@AllClientWithNextAction');
        Route::get('client/all_client_with_action_data', 'ClientActionController@getAllClientWithNextActionData');
        Route::get('client/done_deal', 'ClientActionController@DoneDeal');
        Route::get('client/done_deal_data', 'ClientActionController@getDoneDealData');

    });
    Route::middleware(['notAmbassador'])->group(function () {
        Route::get('all-clients', 'ClientActionController@allClients');
        Route::get('client/get_all_data', 'ClientActionController@getAllData');
        Route::get('new-clients', 'ClientActionController@newClients');
        Route::get('client/get_data/{id}', 'ClientActionController@getData');
        Route::get('action-client/{id}', 'ClientActionController@actionClient');
        Route::get('client/get_todo_data', 'ClientActionController@getToDoData');
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
        //leaves add
        Route::get('leave-app/create', 'LeaveController@create');
        Route::post('leave-app/store', 'LeaveController@store');
        Route::get('leave-app', 'LeaveController@index');
    });
    Route::middleware(['visitDubai'])->group(function () {
        Route::get('visit_dubai', 'ClientActionController@visitDubai');
        Route::get('client/visit_dubai_data', 'ClientActionController@getVisitDubaiData');
    });

});
