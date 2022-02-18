<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //add
    public function addTodoTask(Request $request)
    {
        $newtask = new Task();
        $newtask->description = $request->post('description');
        $newtask->checked = 0;
        $newtask->save();

        return response()->json($newtask->toArray());
    }
    //get list
    public function displayTodoTaskList()
    {
        $data = Task::get();

        return response()->json($data->toArray());
    }
    //edit
    public function editTodoTaskDescription(Request $request)
    {
        $task = Task::find($request->post('id'));
        $task->description = $request->post('description');
        $task->save();

        return response()->json($task->toArray());
    }
    
    //toggle (check / uncheck)
    public function toggle_checkTodoTask(int $id, int $checked, Request $request)
    {
        $task = Task::find($id);
        $task->checked = $checked;
        $task->save();

        return response()->json($task->toArray());
        
    }

    //delete
    public function deleteTodoTask(int $id)
    {
        Task::destroy($id);

        return response()->json('success');
    }
}
