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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('roles.index') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Go Back</a>
                                <form action="{{route('roles.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group role-group">
                                        @foreach($permission as $value)
                                            <div class="form-check">
                                                <input id="permission" class="form-check-input" value="{{$value->id}}"
                                                       type="checkbox"
                                                       name="permission[]">
                                                <label for="permission" class="form-check-label"
                                                       id="{{$value->id}}">{{ucwords(str_replace('-', ' ', $value->name))}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Role</button>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
