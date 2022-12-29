<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::post('/switch-priority', [TaskController::class, 'switchPriority'])->name('tasks.switch_priority');
Route::resource('/', TaskController::class, [ "names" => "tasks", "parameters" => [""=>"task", "parameters" => ["task"] ] ]);
