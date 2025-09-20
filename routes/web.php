<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index');
Route::view('/admin/agents', 'admin.agents.index');

Route::view('/login','auth.index');
Route::view('/signup','user.index');

Route::view('/agents','agents.index');
Route::view('/agent/register','agents.create');

Route::view('/properties','properties.index');
Route::view('/property/{property}','properties.show'); 