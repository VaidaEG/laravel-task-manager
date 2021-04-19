<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $statuses = Status::all();
        $statuses = $statuses->sortBy('name');
        return view('status.index', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
        'status_name' => ['required', 'min:3', 'max:16'],
        ],
        [
        'status_name.required' => 'Please enter status name!',
        'status_name.min' => 'Name is too short!',
        'status_name.max' => 'Name is too long!',
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $status = new Status;
        $status->name = $request->status_name;
        $status->save();
        return redirect()->route('status.index')->with('success_message', 'The status has been successfully created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status, Request $request)
    {
        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $validator = Validator::make($request->all(),
        [
        'status_name' => ['required', 'min:3', 'max:16'],
        ],
        [
        'status_name.required' => 'Please enter status name!',
        'status_name.min' => 'Name is too short!',
        'status_name.max' => 'Name is too long!',
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $status->name = $request->status_name;
        $status->save();
        return redirect()->route('status.index')->with('success_message', 'The status has been successfully updated. Nice job!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        if($status->statusTasksList->count()){
            return redirect()->route('status.index')->with('info_message', 'You can\'t delete status, it has tasks. Nice try!');
        }
        $status->delete();
        return redirect()->route('status.index')->with('info_message', 'The status has been successfully deleted. Nice job!');       
    }
}
