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
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('users.create') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Create User</a>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Last Updated</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img
                                                    src="{{asset($user->media_count ? $user->firstMedia('avatar')->getUrl():'avatar.png')}}"
                                                    width="100px" class="img-fluid" id="avatar" alt="">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $roleName)
                                                        <label
                                                            class="badge @if($roleName=='Admin') badge-danger @else badge-success @endif">{{ $roleName }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $user->updated_at->diffForHumans() }}</td>

                                            <td class="d-flex">
                                                <a class="btn btn-primary btn-sm mr-1"
                                                   href="{{ route('users.show', $user->id) }}">View</a>

                                                @can('user-edit')
                                                    <a class="btn btn-dark btn-sm mr-1"
                                                       href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                @endcan
                                                @can('user-delete')
                                                    <form method="POST"
                                                          action="{{ route('users.destroy', $user->id) }}">
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
