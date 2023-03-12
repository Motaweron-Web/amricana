<?php

use App\Http\Controllers\Admin\AuthActivityController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AuthPlatformController;
use App\Http\Controllers\Supervisor\GroupController;
use App\Http\Controllers\Supervisor\SupervisorController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin','CheckPlatform']], function () {
    Route::get('/supervisor', [SupervisorController::class, 'index'])->name('platform');
});

Route::group(['prefix' => 'platform', 'middleware' => ['auth:admin','CheckPlatform']], function () {

    Route::get('/joinActivaties', [SupervisorController::class, 'joinActivaties'])->name('joinActivaties');
    Route::post('groupColor', [GroupController::class, 'groupColor'])->name('groupColor');
    Route::post('groupMoveCreate', [GroupController::class, 'groupMoveCreate'])->name('groupMoveCreate');
    Route::post('groupMove', [GroupController::class, 'groupMove'])->name('groupMove');
    Route::post('selectTourguide', [GroupController::class, 'selectTourguide'])->name('selectTourguide');


    #### Add Join Groups ####
    Route::post('joinGroup', [GroupController::class, 'joinGroup'])->name('joinGroup');
    Route::post('returnWaitingRoom', [GroupController::class, 'returnWaitingRoom'])->name('returnWaitingRoom');

    #### Add Activaties ####
    Route::post('addActivity', [SupervisorController::class, 'addActivity'])->name('addActivity');

    #### Requests Activities ####
    Route::get('requestsActivity', [SupervisorController::class, 'showRequest'])->name('requests');
    Route::get('getLastRequests', [SupervisorController::class, 'getLastRequests'])->name('get-last-requests');
    Route::post('groupAccept', [SupervisorController::class, 'groupAccept'])->name('groupAccept');
    Route::post('groupNotAccept', [SupervisorController::class, 'groupNotAccept'])->name('groupNotAccept');


    //in break
    Route::get('activityBreak', [SupervisorController::class, 'activityBreak'])->name('activityBreak');

    // group Moves
    Route::get('groupMoves', [SupervisorController::class, 'groupMoves'])->name('groupMoves');


    // logout
    Route::get('platform/logout', [AuthPlatformController::class,'logout'])->name('platform.logout');
    Route::get('activity/logout', [AuthActivityController::class,'logout'])->name('activity.logout');
});


Route::group(['prefix'=>'platform'],function (){

    Route::get('login', [AuthPlatformController::class,'index'])->name('platform.login');
    Route::POST('login', [AuthPlatformController::class,'login'])->name('platform.login');
});

Route::group(['prefix'=>'activity'],function (){

    Route::get('login', [AuthActivityController::class,'index'])->name('activity.login');
    Route::POST('login', [AuthActivityController::class,'login'])->name('activity.login');
});
