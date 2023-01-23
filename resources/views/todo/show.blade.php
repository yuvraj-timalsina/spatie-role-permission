@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Todo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Todo</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <a href="{{ route('todos.index') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Go Back</a>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <img src="{{asset('/storage/'. $todo->image)}}" width="235px" class="mb-2">
                                    <h3>{{$todo->title}}</h3>
                                    <p>
                                        {{$todo->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
