@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                                <a href="{{ route('users.index') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Go Back</a>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5>{{$user->name}}</h5>
                                    <p>
                                        {{$user->email}}
                                    </p>
                                    <p>
                                        <strong>Roles:</strong>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $roleName)
                                                <label class="badge badge-success">{{ $roleName }}</label>
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
