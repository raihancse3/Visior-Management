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

// Route::get('/', function () {
//     return view('welcome');
// });

 //Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Auth\LoginController@index');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['namespace'=>'admin','middleware' => ['auth', 'locale'] ], function() {
Route::get('dashboard','DashboardController@index');
Route::post('language/change','DashboardController@changeLanguage');

// department
Route::get('departments','DepartmentController@index');
Route::get('department/add','DepartmentController@create');
Route::post('department/save','DepartmentController@store');
Route::get('department/edit/{id}','DepartmentController@edit');
Route::post('department/update','DepartmentController@update');
Route::get('dept_delete/{id}','DepartmentController@departDelete');

//////Sections
Route::get('sections/{id}','DepartmentController@sectionList');
Route::get('section/add/{id}','DepartmentController@sectionAdd');
Route::post('section/store','DepartmentController@sectionStore');
Route::get('section_edit/{did}/{sid}','DepartmentController@sectionEdit');
Route::post('section_update','DepartmentController@sectionUpdate');
Route::get('section_delete/{id}','DepartmentController@sectionDelete');
Route::get('get_sections','DepartmentController@sectionListByDept');


Route::get('settings','SettingController@index')->middleware(['permission:manage_site_setting']);
Route::post('setting/store','SettingController@store');

Route::get('smtp/setup','EmailSettingController@index')->middleware(['permission:manage_smtp']);
Route::post('smtp/store','EmailSettingController@store');

// Role
Route::get('admin/roles','RoleController@index')->middleware(['permission:manage_role']);
Route::get('admin/role/add','RoleController@create')->middleware(['permission:add_role']);
Route::post('admin/role/save','RoleController@store');
Route::get('admin/role/edit/{id}','RoleController@edit')->middleware(['permission:edit_role']);
Route::post('admin/role/update','RoleController@update');
Route::get('admin/role/delete/{id}','RoleController@destroy')->middleware(['permission:delete_role']);

// User
Route::get('user/list','UserController@index')->middleware(['permission:manage_user']);
Route::get('user/add','UserController@create')->middleware(['permission:add_user']);
Route::post('user/save','UserController@store');
Route::get('user/edit/{id}','UserController@edit')->middleware(['permission:edit_user']);
Route::post('user/update','UserController@update');
Route::get('user/delete/{id}','UserController@destroy')->middleware(['permission:delete_user']);
Route::get('user/view/{id}','UserController@viewDetail');
Route::get('edit/current-user','UserController@currentUser');
Route::post('user/update-profile','UserController@updateProfile');
Route::get('change-password/{id}','UserController@changePassword');
Route::post('change-password/{id}','UserController@updatePassword');

// Visitor 
Route::get('visitors','VisitorController@index')->middleware(['permission:manage_visitor']);
Route::get('visitor/add','VisitorController@create');
Route::post('visitor/save','VisitorController@store');
Route::get('visitor/edit/{id}','VisitorController@edit');
Route::post('visitor/update','VisitorController@update');
Route::get('visitor/exit/{id}','VisitorController@GetExit');
Route::get('visitor/entry/{id}','VisitorController@GetEntry');
Route::post('visitor/entry_save','VisitorController@EntryStore');
Route::get('visitor/view/{id}','VisitorController@viewDetail');
Route::get('visitor/movements','VisitorController@movementList');
Route::get('visitor/idcard/{id}','VisitorController@makeIdCard');

// Driver 
Route::get('drivers','DriverController@index')->middleware(['permission:manage_driver']);
Route::get('vehicle/movements','DriverController@VehicleMovementList');
Route::get('driver/add','DriverController@create');
Route::post('driver/save','DriverController@store');
Route::get('driver/edit/{id}','DriverController@edit');
Route::post('driver/update','DriverController@update');
Route::get('driver/exit_entry/{id}','DriverController@ExitEntry');
Route::post('driver/entry_save','DriverController@ExitStore');
Route::get('driver/return_entry/{id}','DriverController@ReturnEntry');
Route::post('driver/return_save','DriverController@ReturnStore');
Route::get('driver/idcard/{id}','DriverController@makeIdCard');

});