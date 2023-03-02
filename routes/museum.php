<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Supervisor\GroupController;
use App\Http\Controllers\Supervisor\SupervisorController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'platform', 'middleware' => ['auth:admin','CheckPlatform']], function () {

    Route::get('/', [SupervisorController::class, 'index'])->name('platform');
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


    // logout
    Route::get('logout', [AuthController::class,'logoutPlatform'])->name('platform.logout');
});
