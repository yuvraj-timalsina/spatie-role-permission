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
                        <div class="card">
                            <div class="card-body">
                                @can('role-create')
                                <a href="{{ route('roles.create') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Create Role</a>
                                @endcan
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Last Updated</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->updated_at->diffForHumans() }}</td>
                                            <td class="d-flex">
                                                <a class="btn btn-primary btn-sm mr-1"
                                                   href="{{ route('roles.show', $role->id) }}">View</a>
                                                @can('role-edit')
                                                <a class="btn btn-dark btn-sm mr-1"
                                                   href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                @endcan
                                                @can('role-delete')
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
