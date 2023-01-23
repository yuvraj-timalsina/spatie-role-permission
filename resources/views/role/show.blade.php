@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
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
                                <a href="{{ route('roles.index') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Go Back</a>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5>{{$rolePermission->name}}</h5>
                                    <p>
                                        <strong>Permissions:</strong>

                                        @foreach($rolePermission->permissions  as $value    )
                                            <label class="badge badge-success">{{ mb_strtoupper($value->name) }}</label>
                                        @endforeach

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
