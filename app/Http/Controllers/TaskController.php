<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Status;
use Validator;
use PDF;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statuses = Status::all();
        if ($request->status_id) {
            $tasks = Task::where('status_id', $request->status_id)->get();
            $filterBy = $request->status_id;
        }
        else {
            $tasks = Task::all();
            $tasks = $tasks->sortByDesc('add_date');
        }
        return view('task.index', ['tasks' => $tasks, 'statuses' => $statuses, 'filterBy' => $filterBy ?? 0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses= Status::all();
        $statuses = $statuses->sortBy('add_date');
        return view('task.create', ['statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
        'task_name' => ['required', 'min:3', 'max:128'],
        'task_description' => ['required', 'min:1', 'max:1500'],
        'add_date' => ['required'],
        'completed_date' => ['required'],
        'status_id' => ['required'],
        ],
        [
        'task_name.required' => 'Please enter task name!',
        'task_description.required' => 'Please enter information about the task!',
        'task_name.min' => 'Name is too short!',
        'task_name.max' => 'Name is too long!',
        'task_description.max' => 'Text is too long!',
        'task_description.min' => 'Text is too short!',
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $task = new Task;
        $task->task_name = $request->task_name;
        $task->task_description = $request->task_description;
        $task->add_date = $request->add_date;
        $task->completed_date = $request->completed_date;
        $task->status_id = $request->status_id;
        $task->save();
        return redirect()->route('task.index')->with('success_message', 'The task has been successfully created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = Status::all();
        return view('task.edit', ['task' => $task, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(),
        [
        'task_name' => ['required', 'min:3', 'max:128'],
        'task_description' => ['required', 'min:1', 'max:1500'],
        'add_date' => ['required'],
        'completed_date' => ['required'],
        'status_id' => ['required'],
        ],
        [
        'task_name.required' => 'Please enter task name!',
        'task_description.required' => 'Please enter information about the task!',
        'task_name.min' => 'Name is too short!',
        'task_name.max' => 'Name is too long!',
        'task_description.max' => 'Text is too long!',
        'task_description.min' => 'Text is too short!',
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $task->task_name = $request->task_name;
        $task->task_description = $request->task_description;
        $task->add_date = $request->add_date;
        $task->completed_date = $request->completed_date;
        $task->status_id = $request->status_id;
        $task->save();
        return redirect()->route('task.index')->with('success_message', 'The task has been successfully updated. Nice job!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->with('info_message', 'The task has been successfully deleted. Nice job!');
    }
    public function pdf(Task $task) 
    {
        $pdf = PDF::loadView('task.pdf', ['task' => $task]);
        return $pdf->download('task->id' . $task->id . '.pdf');
    }
}
