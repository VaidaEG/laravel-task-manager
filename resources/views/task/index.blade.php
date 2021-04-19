@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Task List <i class="fas fa-tasks"></i></h2>
                    <form action="{{route('task.index')}}" method="get" class="make-inline">
                        <label>Tasks: </label>
                        <div class="form-group form-inline d-flex justify-content-between">
                            <select class="form-control header-select" name="status_id">
                                <option value="0" disabled @if($filterBy == 0) selected @endif>Select status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" @if($filterBy == $status->id) selected @endif>
                                        {{$status->name}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-center buttons">
                            <button type="submit" class="btn btn-primary crud mr-3" title="filter"><i class="fas fa-search"></i></button>
                            <a class="btn btn-primary crud" href="{{route('task.index')}}" title="clear filter"><i class="fas fa-times-circle"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @foreach ($tasks as $task)
                        <li class="list-group-item list-line d-flex justify-content-between color">
                            <div class="list-content">
                                <h5>{{$task->task_name}}</h5>
                                <p>Task description: {!!$task->task_description!!}</p>
                                <p>Date created: {{$task->add_date}}</p>
                                <p>Deadline: {{$task->completed_date}}</p>
                            </div>
                            <div class="d-flex justify-content-center buttons">
                                <a href="{{route('task.pdf', [$task])}}" class="btn btn-primary crud mr-3" type="submit" title="pdf"><i class="fas fa-file-pdf"></i></button>
                                <a class="btn btn-primary crud mr-3" href="{{route('task.edit',[$task])}}" title="edit"><i class="fas fa-edit"></i></a>
                                <form style="display: inline-block;" method="POST" action="{{route('task.destroy', [$task])}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit" title="delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection