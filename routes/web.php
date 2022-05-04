<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;


/*
|--------------------------------------------------------------------------
| Веб-Маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать веб-маршруты для своего приложения. Эти |маршруты загружает RouteServiceProvider внутри группы, которая содержит |группу промежуточного программного обеспечения «web». А теперь создайте что-|нибудь замечательное!
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard',[TasksController::class, 'index'])->name('dashboard');

    Route::get('/task',[TasksController::class, 'add']);
    Route::post('/task',[TasksController::class, 'create']);
    Route::get('/task/v/{task}', [TasksController::class, 'view']);
    Route::get('/task/{task}', [TasksController::class, 'edit']);
    Route::post('/task/{task}', [TasksController::class, 'update']);
});
