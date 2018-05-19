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

Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'DashboardController@index');
    /* ----- SETTINGS------*/
    /*Employee*/
    Route::get('/settings/employee/', 'EmployeeController@show')->name('settings.employee');
    Route::get('/settings/employee/upload', 'EmployeeController@uploadForm')->name('settings.employee.upload');
    Route::post('/settings/employee/upload', 'EmployeeController@upload');
    Route::get('/settings/employee/{employee}/edit', 'EmployeeController@editForm')->name('settings.employee.edit');
    Route::patch('/settings/employee/{employee}/update', 'EmployeeController@update')->name('settings.employee.update');
    Route::get('/settings/employee/create', 'EmployeeController@createForm')->name('settings.employee.create');
    Route::post('/settings/employee/store', 'EmployeeController@store')->name('settings.employee.store');
    /*Position*/
    Route::get('/settings/position/', 'PositionController@show')->name('settings.position');
    Route::get('/settings/position/upload', 'PositionController@uploadForm')->name('settings.position.upload');
    Route::post('/settings/position/upload', 'PositionController@upload');
    Route::get('/settings/position/{position}/edit', 'PositionController@editForm')->name('settings.position.edit');
    Route::patch('/settings/position/{position}/update', 'PositionController@update')->name('settings.position.update');
    Route::get('/settings/position/create', 'PositionController@createForm')->name('settings.position.create');
    Route::post('/settings/position/store', 'PositionController@store')->name('settings.position.store');
    /*Department*/
    Route::get('/settings/department/', 'DepartmentController@show')->name('settings.department');
    Route::get('/settings/department/upload', 'DepartmentController@uploadForm')->name('settings.department.upload');
    Route::post('/settings/department/upload', 'DepartmentController@upload');
    Route::get('/settings/department/{department}/edit', 'DepartmentController@editForm')->name('settings.department.edit');
    Route::patch('/settings/department/{department}/update', 'DepartmentController@update')->name('settings.department.update');
    Route::get('/settings/department/create', 'DepartmentController@createForm')->name('settings.department.create');
    Route::post('/settings/department/store', 'DepartmentController@store')->name('settings.department.store');
    /*DefaultType*/
    Route::get('/settings/defaulttype/', 'DefaultTypeController@show')->name('settings.defaulttype');
    Route::get('/settings/defaulttype/{defaulttype}/edit', 'DefaultTypeController@editForm')->name('settings.defaulttype.edit');
    Route::patch('/settings/defaulttype/{defaulttype}/update', 'DefaultTypeController@update')->name('settings.defaulttype.update');
    Route::get('/settings/defaulttype/create', 'DefaultTypeController@createForm')->name('settings.defaulttype.create');
    Route::post('/settings/defaulttype/store', 'DefaultTypeController@store')->name('settings.defaulttype.store');
    /*Holiday*/
    Route::get('/settings/holiday/', 'HolidayController@show')->name('settings.holiday');
    Route::get('/settings/holiday/{holiday}/edit', 'HolidayController@editForm')->name('settings.holiday.edit');
    Route::patch('/settings/holiday/{holiday}/update', 'HolidayController@update')->name('settings.holiday.update');
    Route::get('/settings/holiday/create', 'HolidayController@createForm')->name('settings.holiday.create');
    Route::post('/settings/holiday/store', 'HolidayController@store')->name('settings.holiday.store');
    Route::get('/settings/holiday/{holiday}/destroy', 'HolidayController@destroyForm')->name('settings.holiday.destroy');
    Route::delete('/settings/holiday/{holiday}/destroy', 'HolidayController@destroy');
    /*User*/
    Route::get('/settings/user/', 'UserController@show')->name('settings.user');
    Route::get('/settings/user/{user}/edit', 'UserController@editForm')->name('settings.user.edit');
    Route::patch('/settings/user/{user}/update', 'UserController@update')->name('settings.user.update');
    Route::get('/settings/user/create', 'UserController@createForm')->name('settings.user.create');
    Route::post('/settings/user/store', 'UserController@store')->name('settings.user.store');
    Route::get('/settings/user/{user}/block', 'UserController@blockForm')->name('settings.user.block');
    Route::patch('/settings/user/{user}/block', 'UserController@block');
    Route::get('/settings/user/{user}/changepswd', 'UserController@changepswdForm')->name('settings.user.changepswd');
    Route::patch('/settings/user/{user}/changepswd', 'UserController@changepswd');

    /*===============================================================================================================*/
    /* My Employee*/
    Route::get('/my_employees', 'MyEmployeeController@show')->name('my.employee');
    Route::get('/my_employees/create', 'MyEmployeeController@createForm')->name('my.employee.create');
    Route::post('/my_employees/store', 'MyEmployeeController@store')->name('my.employee.store');
    /* Формирование данных для медперсонала*/
    Route::get('/my_employees/create/medicall_staff', 'MyEmployeeController@createFormMedicallStaf')->name('my.employee.create.medicalstaff');
    Route::post('/my_employees/create/medicall_staff_create', 'MyEmployeeController@storeMedicallStaf')->name('my.employee.store.medicalstaff');
    /* Формирование данных по индивидуальному сотруднику*/
    Route::get('/my_employees/create/individually', 'MyEmployeeController@createFormIndividually')->name('my.employee.create.individually');
    Route::post('/my_employees/create/individually_store', 'MyEmployeeController@storeIndividually')->name('my.employee.store.individually');
    /* Формирование данных для не медерсонала*/
    Route::get('/my_employees/create/not_medicall_staff', 'MyEmployeeController@createFormNotMedicallStaf')->name('my.employee.create.notmedicalstaff');
    Route::post('/my_employees/create/not_medicall_staff_create', 'MyEmployeeController@storeNotMedicallStaf')->name('my.employee.store.notmedicalstaff');
    /* Сформировать график */
    Route::get('/my_employees/chart', 'MyEmployeeController@storeChart')->name('my.employee.store.chart');
    /* Сформировать табель*/
    Route::get('/my_employees/report_card', 'MyEmployeeController@storeReportCard')->name('my.employee.store.report.card');
    /*===============================================================================================================*/
    /* No-shows (неявки) */
    Route::get('no-shows', 'NoShowsController@show')->name('no.shows');
    Route::get('no-shows/create', 'NoShowsController@createForm')->name('no.shows.create');
    Route::post('no-shows/store', 'NoShowsController@store')->name('no.shows.store');
    Route::get('no-shows/{noShows}/edit', 'NoShowsController@editForm')->name('no.shows.edit');
    Route::patch('no-shows/{noShows}/update', 'NoShowsController@update')->name('no.shows.update');
    /*==========================================================================================================*/
    /* Combinations (совмещения) */
    Route::get('/combinations/', 'CombinationController@show')->name('combination');
    Route::get('/combinations/create', 'CombinationController@createForm')->name('combination.create');
    Route::post('/combinations/store', 'CombinationController@store')->name('combination.store');
    Route::get('/combinations/{combination}/edit', 'CombinationController@editForm')->name('combination.edit');
    Route::patch('/combinations/{combination}/update', 'CombinationController@update')->name('combination.update');
    /*===========================================================================================================*/
    /* Dismissal (увольнения) */
    Route::get('/dismissal/', 'DismissalController@show')->name('dismissal');
    Route::get('/dismissal/create', 'DismissalController@createForm')->name('dismissal.create');
    Route::post('/dismissal/store', 'DismissalController@store')->name('dismissal.store');
    Route::get('/dismissal/{dismissal}/edit', 'DismissalController@editForm')->name('dismissal.edit');
    Route::patch('/dismissal/{dismissal}/update', 'DismissalController@update')->name('dismissal.update');
    /*================================================================================================================*/
    /* Schedule (графики)*/
    Route::get('/schedule', 'ScheduleController@showList')->name('schedule');
    Route::get('/schedule/{department}/{month}/show', 'ScheduleController@show')->name('schedule.show');
    Route::post('/schedules/ajax_update', 'ScheduleController@ajax')->name('schedule.update.ajax');
    /*================================================================================================================*/
    /* Timetable (табель)*/
    Route::get('/timetable', 'TimetableController@showList')->name('timetable');
    Route::get('/timetable/{department}/{month}/show', 'TimetableController@show')->name('timetable.show');
    Route::post('/timetable/ajax_update', 'TimetableController@ajax')->name('timetable.update.ajax');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
