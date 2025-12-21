<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\AgentProfileConttroller;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookMarkController;
use App\Http\Controllers\DashboardPropertyController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    $properties = Property::latest()->where('status','approved')->paginate(5);
    return view('home.index',['properties'=>$properties]);
});

Route::get('/home', function(){
    $properties = Property::latest()->paginate(5);
    return view('home.index',['properties'=>$properties]);
});

Route::Post('/bookmark/{property}',[BookMarkController::class,'store'])->middleware('auth');

Route::view('/about','home.about');


Route::controller(UserController::class)->group(function (){
    Route::get('/signup','create');
    Route::post('/signup','store');

    Route::get('/admin/customers','adminAgentsIndex');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login','create')->name('login');
    Route::post('/login','store');
    Route::delete('/logout','destroy');
    Route::post('/logout','destroy');
});

Route::controller(AgentController::class)->group(function (){
    Route::get('/agents','index')->name('agents.index');
    Route::get('/agent/register','create');
    Route::get('/agent/{agent}','show');
    // Route::get('/dashboard/profile/edit','edit')->middleware('auth')->can('isAgent','App\Models\Agent');

    Route::post('/agent/register','store');
    // Route::PUT('/dashboard/profile/edit','update')->middleware('auth')->can('isAgent','App\Models\Agent');

});

Route::controller(AgentProfileConttroller::class)->group(function(){
    Route::get('/dashboard/profile','show')->middleware('auth')->can('isAgent','App\Models\Agent');

    Route::PUT('/dashboard/profile','update')->middleware('auth')->can('isAgent','App\Models\Agent');

    // display agents for admin page
    Route::get('/admin/agents', 'adminAgentsIndex');
    Route::get('/admin/agents/{agent}', 'getAgentInfo');
});

Route::controller(PropertyController::class)->group(function (){
    Route::get('/properties','index');
    Route::get('/property/{property}','show')->middleware(['auth','can:view,property']);
    Route::get('/property/{property}/{message}','show')->middleware(['auth','can:view,property']);

    Route::post('/properties','search');
    Route::post('/property/sort','sortProperties');

    // agents dashboard
    Route::get('/dashboard/property/{porperty}','getPropertyInfo')->middleware(['auth','can:create,App\Models\Property']);

    // admin page 
    Route::get('/admin/properties','adminPropertyIndex');
    Route::get('/admin/properties/{property}','getPropertyInfo');
});

Route::controller(DashboardPropertyController::class)->group(function(){

    Route::get('/dashboard/properties','index')->middleware(['auth','can:manages,App\Models\Property']);
    Route::get('/dashboard/property/create','create')->middleware(['auth']);
    Route::get('/dashboard/property/edit/{property}','edit')->middleware(['auth','can:create,App\Models\Property']);
    
    Route::post('/dashboard/property/create','store')
            ->middleware(['auth','can:create,App\Models\Property']);

    Route::put('/dashboard/property/update/{property}','update')
            ->middleware(['auth','can:create,App\Models\Property']);

    Route::delete('/dashboard/property/delete/{property}','destroy')
            ->middleware(['auth','can:create,App\Models\Property']);
            
    Route::get('/agent/appointments/search','search')
            ->name('agent.appointments.search');


});

Route::controller(AppointmentController::class)->group(function(){
    // Route::get('')
    Route::get('/schedules','index')->middleware(['auth']);
    Route::get('/schedule/{property}','create')->middleware(['auth'])->can('view','property','App\Models\Property');

    Route::post('/schedule','store')->middleware(['auth']);
    Route::put('/schedules/{Appointment}','statusUpdate')->middleware(['auth']);
    Route::patch('/appointments/{appointment}/cancel', 'cancel')
                ->middleware('auth')->name('appointments.cancel');
    Route::patch('/appointments/{appointment}/reschedule', 'reschedule')
                ->middleware('auth')->name('appointments.reschedule');
    Route::patch('/appointments/{appointment}/complete', 'complete')
            ->middleware('auth')->name('appointments.complete');



    // dashboards appointment page
    Route::get('/dashboard/appointments','dashboardIndex')->middleware(['auth'])->can('isAgent','App\Models\Agent');
    Route::get('/dashboard/appointments/{appointment}','show')->middleware(['auth'])->can('isAgent','App\Models\Agent');
    Route::put('/dashboard/appointment/{appointment}','statusUpdate')->middleware(['auth'])->can('isAgent','App\Models\Agent');
});
 
Route::controller(SettingController::class)->group(function () {
    Route::get('/dashboard/settings','index')->middleware(['auth'])->can('isAgent','App\Models\Agent');

    Route::put('/dashboard/settings','update')->middleware(['auth'])->can('isAgent','App\Models\Agent');
    Route::delete('/dashboard/settings/delete','destroy')->middleware(['auth'])->can('isAgent','App\Models\Agent');
});

Route::controller(MediaController::class)->group(function () {
    Route::post('/dashboard/media','update')->middleware('auth');
});

Route::controller(EarningController::class)->group(function (){
    Route::get('/dashboard/earnings','index')->middleware(['auth'])->can('isAgent','App\Models\Agent');

    // ->middleware(['auth'])->can('isAgent','App\Models\Agent');

    // checkout request
    Route::post('/dashboard/earnings','store');
    Route::delete('/checkout/delete/{checkoutRequest}','cancelCheckOutReq');//->middleware(['auth']);
});

Route::controller(TransactionController::class)->group(function () {
    Route::get('/admin/transactions','index');
});

Route::controller(AnalyticsController::class)->group(function () {
    Route::get('/admin/analytics','index');
    Route::get('/admin/analytics/pdf','generatePdf');
});

Route::controller(AgentDashboardController::class)->group(function(){
    Route::get('/dashboard','index')->middleware(['auth'])->can('isAgent','App\Models\Agent');
    Route::get('/dashboard/home','index')->middleware(['auth'])->can('isAgent','App\Models\Agent');
});


Route::post('/agent/rate', [ReviewController::class, 'store'])->name('agent.rate')->middleware('auth');

// user profile page
Route::get('/profile',[UserProfileController::class,'index'])->middleware('auth')->name('user.profile');
Route::put('/profile/update', [UserProfileController::class, 'update'])->middleware('auth');
Route::post('/profile/photo', [MediaController::class, 'update'])->middleware('auth');
Route::put('/profile/security/password', [UserProfileController::class, 'updatePassword'])->middleware('auth');
Route::put('/profile/security/2fa', [SettingController::class, 'update']);
Route::put('/profile/preferences', [SettingController::class, 'update'])->middleware('auth');
Route::middleware('auth')->delete('/profile/delete', [SettingController::class, 'destroy']);


// admin dashboard navigations
Route::view('/admin','admin.dashboard');
Route::view('/admin/settings','admin.settings');
Route::view('/admin/profile','admin.profile.index');




// test routes
Route::get('admin/agents/export/', [AgentController::class, 'export']);
Route::get('admin/users/export/', [UserController::class, 'export']);


