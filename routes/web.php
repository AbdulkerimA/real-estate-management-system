<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index');
Route::view('/home', 'home.index');
Route::view('/about','home.about');
Route::view('/admin/agents', 'admin.agents.index');

Route::controller(UserController::class)->group(function (){
    Route::get('/signup','create');
    Route::post('/signup','store');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login','create');
    Route::post('/login','store');
});

Route::controller(AgentController::class)->group(function (){
    Route::get('/agents','index');
    Route::get('/agent/register','create');
    Route::get('/agent/{agent}','show');

    Route::post('/agent/register','store');
});

Route::controller(PropertyController::class)->group(function (){
    Route::get('/properties','index');
    Route::get('/property/{property}','show')->middleware('auth');
});

Route::controller(AppointmentController::class)->group(function(){
    Route::get('/schedule/{property}','create')->middleware('auth');
});

Route::view('/dashboard','agents.dashboard');
Route::view('/dashboard/home','agents.dashboard');
Route::get('/dashboard/properties',function () {
    // $properties = properties::paginate(10);
    // dd($properties);
    // return view('agents.properties.index',['properties'=>$properties]);
});
Route::view('/dashboard/property/create','agents.properties.create');

Route::view('/dashboard/appointments','agents.appointments.index');
Route::view('/dashboard/earnings','agents.earning.index');
Route::view('/dashboard/profile','agents.profile.index');
Route::view('/dashboard/settings','agents.settings.index');

