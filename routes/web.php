<?php

use App\Models\properties;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index');
Route::view('/home', 'home.index');
Route::view('/about','home.about');
Route::view('/admin/agents', 'admin.agents.index');

Route::view('/login','auth.index');
Route::view('/signup','user.index');

Route::view('/agents','agents.index');
Route::view('/agent/register','agents.create');
Route::view('/agent/{agent}','agents.show');

Route::view('/properties','properties.index');
Route::view('/property/{property}','properties.show'); 

Route::view('/schedule/{property}','schedule.create');

Route::view('/dashboard','agents.dashboard');
Route::view('/dashboard/home','agents.dashboard');
// Route::view('/dashboard/properties','agents.properties.index');
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

