<?php

use App\Http\Controllers\TodoController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    $newtask = Task::find(1);
    $newtask->description = 'belajar 2';
    $newtask->save();
    return "arsyad ". $newtask;
});

Route::post('add_todo', [TodoController::class, 'addTodoTask']);
Route::get('get_todo_list', [TodoController::class, 'displayTodoTaskList']);
Route::post('get_todo_edit', [TodoController::class, 'editTodoTaskDescription']);
Route::get('check_todo/{id}/{checked}', [TodoController::class, 'toggle_checkTodoTask']);
Route::get('delete_todo/{id}', [TodoController::class, 'deleteTodoTask'])->name('delete');

Route::get('download_pdf', [TodoController::class, 'download_pdf'])->name('download');
