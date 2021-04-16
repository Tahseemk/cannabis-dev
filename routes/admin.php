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
  return redirect(route('admin',app()->getLocale()));
});

Route::group([
  'prefix' => '{locale}',
  'where' => ['locale' => '[a-zA-Z]{2}'],
  'middleware' => 'setlocale'
  ],
  function() {
    Route::get('/', 'LoginController@showLoginForm')->name('admin');
    Route::post('adminlogin', 'LoginController@login')->name('adminLogin');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('forgotpassword', 'LoginController@forgotpassword')->name('login.forgotpassword');
    Route::post('forgotpassword', 'LoginController@processforgotpass')->name('login.processforgotpass');
  }
);


Route::group([
  'prefix' => '{locale}',
  'where' => ['locale' => '[a-zA-Z]{2}'],
  'middleware' => ['setlocale','adminRole']
  ], function (){
  Route::get('dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('dashboard/editprofile', 'DashboardController@editProfile')->name('dashboard.editprofile');
  Route::post('dashboard/updateprofile', 'DashboardController@updateprofile')->name('dashboard.updateprofile');
  Route::get('dashboard/setting', 'DashboardController@setting')->name('dashboard.setting');
  Route::post('dashboard/updatesetting', 'DashboardController@updatesetting')->name('dashboard.updatesetting');
  Route::resource('admin_user', 'AdminController');
  Route::resource('company_user', 'CompanyController');
  Route::resource('service_location', 'LocationController');
  Route::post('getadmins', 'AdminController@getAdmins')->name('getadmins');
  Route::resource('truck', 'TruckController');
  Route::post('getcompanies', 'CompanyController@getCompanies')->name('getcompanies');
  Route::post('getcompanysalesusers', 'CompanyController@getCompanySalesUsers')->name('getcompanysalesusers');
  Route::post('getlocations', 'LocationController@getLocations')->name('getlocations');
  Route::post('gettrucks', 'TruckController@getTrucks')->name('gettrucks');
  Route::resource('sales_user', 'SalesController');
  Route::post('getsalesusers', 'SalesController@getSalesUsers')->name('getsalesusers');
  Route::get('sales_user/{site}/delete', ['as' => 'sales_user.delete', 'uses' => 'SalesController@destroy']);
  Route::resource('template', 'TemplateController');
  Route::post('getTemplates', 'TemplateController@getTemplates')->name('getTemplates');
  Route::resource('job', 'JobController');
  Route::post('getserviceform', 'JobController@getServiceForm')->name('getserviceform');
  Route::post('getinsulationoptionform', 'JobController@getInsulationOptionForm')->name('getinsulationoptionform');
  Route::post('getjobs', 'JobController@getJobs')->name('getjobs');
  Route::post('getavailability', 'JobController@getAvailability')->name('getavailability');
  Route::get('getcalendarjobs', 'JobController@getCalendarJobs')->name('getcalendarjobs');
  Route::post('getselectedcompanysalesusers', 'JobController@getSelectedCompanySalesUsers')->name('getselectedcompanysalesusers');
  Route::post('updatetrucklist', 'JobController@updateTruckList')->name('updatetrucklist');
  Route::post('savecomment', 'JobController@saveComment')->name('job.savecomment');
  Route::post('getjobcomments', 'JobController@getJobComments')->name('job.getjobcomments');
  Route::post('upload_image', 'JobController@uploadImage')->name('upload_image');
  Route::post('remove_uploaded_image', 'JobController@removeUploadImage')->name('remove_uploaded_image');
  Route::post('check_uploaded_image', 'JobController@checkUploadImage')->name('check_uploaded_image');
  Route::post('getcompaniesname', 'JobController@getCompaniesName')->name('getcompaniesname');
});