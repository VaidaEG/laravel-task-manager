@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h3>Edit Status</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('status.update',[$status->id])}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="status_name" value="{{old('status_name', $status->name)}}">
                            <small class="form-text text-muted">Please edit status name.</small>
                        </div>
                        @csrf
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary crud" type="submit" title="edit"><i class="fas fa-check"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection