<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentProfileConttroller;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardPropertyController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    $properties = Property::latest()->paginate(5);
    return view('home.index',['properties'=>$properties]);
});

Route::get('/home', function(){
    $properties = Property::latest()->paginate(5);
    return view('home.index',['properties'=>$properties]);
});

Route::view('/about','home.about');
Route::view('/admin/agents', 'admin.agents.index');

Route::controller(UserController::class)->group(function (){
    Route::get('/signup','create');
    Route::post('/signup','store');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login','create')->name('login');
    Route::post('/login','store');
});

Route::controller(AgentController::class)->group(function (){
    Route::get('/agents','index');
    Route::get('/agent/register','create');
    Route::get('/agent/{agent}','show');
    Route::get('/dashboard/profile/edit','edit');

    Route::post('/agent/register','store');
    Route::PUT('/dashboard/profile/edit','update');
});

Route::controller(AgentProfileConttroller::class)->group(function(){
    Route::get('/dashboard/profile','show')->middleware('auth');
    Route::get('/dashboard/profile/edit','edit')->middleware('auth');

    Route::PUT('/dashboard/profile/edit','update')->middleware('auth');
});

Route::controller(PropertyController::class)->group(function (){
    Route::get('/properties','index');
    Route::get('/property/{property}','show')->middleware(['auth','can:view,property']);
    Route::get('/property/{property}/{message}','show')->middleware(['auth','can:view,property']);
});

Route::controller(DashboardPropertyController::class)->group(function(){
    Route::get('/dashboard/properties','index')->middleware(['auth','can:viewAny']);
    Route::get('/dashboard/property/create','create')->middleware(['auth','can:create']);

    Route::post('/dashboard/property/create','store')->middleware(['auth','can:create']);
});

Route::controller(AppointmentController::class)->group(function(){
    // Route::get('')
    Route::get('/schedule/{property}','create')->middleware('auth');
    Route::get('/dashboard/appointments','index');

    Route::post('/schedule','store')->middleware('auth');
});

Route::controller(SettingController::class)->group(function () {
    Route::get('/dashboard/settings','index');

    Route::put('/dashboard/settings','update');
    Route::delete('/dashboard/settings/delete','destroy');
});

Route::view('/dashboard','agents.dashboard');
Route::view('/dashboard/home','agents.dashboard');

Route::view('/dashboard/earnings','agents.earning.index');

