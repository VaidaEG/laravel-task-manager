@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Status List <i class="fas fa-user"></i></h2>
                </div>
                <div class="card-body">
                    @foreach ($statuses as $status)
                        <li class="list-group-item list-line d-flex justify-content-between color">
                            <div class="list-content">
                                <h5>{{$status->name}}</h5>
                            </div>
                            <div class="d-flex justify-content-center buttons">
                                <a href="{{route('status.edit', [$status])}}" class="btn btn-primary crud mr-3" title="edit"><i class="fas fa-edit"></i></a>
                                <form style="display: inline-block;" method="POST" action="{{route('status.destroy', [$status])}}">
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