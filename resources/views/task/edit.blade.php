@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h3>Edit task</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('task.update',[$task])}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="task_name" value="{{old('task_name', $task->task_name)}}">
                            <small class="form-text text-muted">Please edit task name.</small>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea id="summernote" name="task_description">{{old('task_description', $task->task_description)}}</textarea>
                            <small class="form-text text-muted">Please edit information about task.</small>
                        </div>
                        <div class="form-group">
                            <label>Created:</label>
                            <input class="form-control" name="add_date" value="{{old('add_date', $task->add_date)}}">
                            <small class="form-text text-muted">Please edit current date.</small>
                        </div>
                        <div class="form-group">
                            <label>Deadline:</label>
                            <input class="form-control" name="completed_date" value="{{old('completed_date', $task->completed_date)}}">
                            <small class="form-text text-muted">Please edit deadline date.</small>
                        </div>
                        <div class="form-group">
                            <label>Select status:</label>
                            <select class="form-control body-select" name="status_id">
                                <option value="0" disabled selected>Select status</option>
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}" @if($status->id == $task->status_id) selected @endif>{{$status->name}}
                            @endforeach
                        </select>
                            <small class="form-text text-muted">Please edit status for task.</small>
                        </div>
                        @csrf
                        <div class="d-flex justify-content-end">
                        <button class="btn btn-primary crud" type="submit" title="add"><i class="fas fa-check"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    $('#summernote').summernote();
});
</script>
@endsection