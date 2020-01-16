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
    return view('welcome');
});

//login
Route::match(['get','post'],'/login','LoginController@login')->name('login');

//doctor_schedule
Route::match(['get','post'],'/doctor','LoginController@doctor_schedule')->name('doctor');

//forbiden
Route::get('/forbidden','LoginController@forbidden');

Route::group(['middleware'=>['auth']],function(){

	//profile
	Route::match(['get','post'],'/edit_profile','LoginController@editProfile');

	//logout
	Route::get('/logout','LoginController@logout');

	//doctor
	Route::get('/dokter','DoctorController@showDokter');
	Route::match(['get','post'],'/add_doctor','DoctorController@addDokter');
	Route::match(['get','post'],'/edit_doctor/{id}','DoctorController@editDoctor');
	Route::match(['get','post'],'/delete_doctor/{id}','DoctorController@deleteDoctor');
	
	//dashboard
	Route::get('/dashboard','LoginController@index');

	//user
	Route::get('/user','UserController@showUser');
	Route::match(['get','post'],'/add_user','UserController@addUser');
	Route::match(['get','post'],'/edit_user/{id}','UserController@editUser');
	Route::match(['get','post'],'/delete_user/{id}','UserController@deleteUser');

	//specialization
	Route::get('/specialization','SpecializationController@showSpecialization');
	Route::match(['get','post'],'/add_specialization','SpecializationController@addSpecialization');
	Route::match(['get','post'],'/edit_specialization/{id}','SpecializationController@editSpecialization');
	Route::match(['get','post'],'/delete_specialization/{id}','SpecializationController@deleteSpecialization');

	//room
	Route::get('/room_history','RoomController@roomHistory');
	Route::get('/room_status','RoomController@roomStatus');
	Route::match(['get','post'],'/add_room','RoomController@addRoom');
	Route::match(['get','post'],'/edit_room/{id}','RoomController@editRoom');
	Route::match(['get','post'],'/delete_room/{id}','RoomController@deleteRoom');
	Route::match(['get','post'],'/edit_status_room/{id}','RoomController@editStatusRoom');
	Route::match(['get','post'],'/off_room/{id}','RoomController@offRoom');

	//schedule
	Route::get('/schedule_history','ScheduleController@scheduleHistory');
	Route::get('/doctor_schedule','ScheduleController@doctorSchedule');
	Route::match(['get','post'],'/add_schedule','ScheduleController@addSchedule');
	Route::match(['get','post'],'/edit_schedule/{id}','ScheduleController@editSchedule');
	Route::match(['get','post'],'/delete_schedule/{id}','ScheduleController@deleteSchedule');


});