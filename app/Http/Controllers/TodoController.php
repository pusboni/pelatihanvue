<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use PDF;

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
        $responsePayload = [];

        foreach ($data as $task) {
            unset($temp);
            $temp = $task->toArray();
            $temp['status'] = ($temp['checked'] == 1 ? true : false);
            $temp['title'] = $temp['description'];
            $responsePayload[] = $temp;
        }

        return response()->json($responsePayload);
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
        if ($checked <= 0) {
            $checked = 0;
        }else{
            $checked = 1;
        }
        
        $task = Task::find($id);
        $task->checked = $checked;
        $task->save();

        $responsdata = $task->toArray();
        $responsdata['status'] = ($responsdata['checked'] == 1 ? true : false);
        $responsdata['title'] = $responsdata['description'];

        // dd($responsdata);
        // unset($responsdata['checked']);
        // unset($responsdata['description']);


        return response()->json($responsdata);
        
    }

    //delete
    public function deleteTodoTask(int $id)
    {
        Task::destroy($id);

        return response()->json('success');
    }

    public function download_pdf()
    {
        // return PDF::loadFile('https://www.google.com/')->inline('google.pdf');
        $tasklist = Task::get();
        $pdf = PDF::loadView('pdfview', compact('tasklist'));

        return $pdf->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->download('task.pdf');
    }
}
