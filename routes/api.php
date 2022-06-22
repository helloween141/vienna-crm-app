<?php

use App\Http\Controllers\API\CoreController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\DashboardController;

Route::post('login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('', function (Request $request) {
        return $request->user();
    });
    Route::get('settings', function (Request $request) {});
    Route::post('create', function (Request $request) {});
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UserController::class, 'getAll']);
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::get('statistics', [DashboardController::class, 'getStatistic']);
    Route::get('active-tasks', [DashboardController::class, 'getActiveTasks']);
});

Route::group(['prefix' => 'core', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/sidebar/{model}', [CoreController::class, 'getSidebar']);
    Route::get('/record/{model}/{recordId}', [CoreController::class, 'getData']);
    Route::get('/record/{model}', [CoreController::class, 'getInterface']);
    Route::post('/record/{model}/{recordId?}', [CoreController::class, 'save']);
});
