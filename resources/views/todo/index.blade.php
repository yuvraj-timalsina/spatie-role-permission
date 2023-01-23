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
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('todos.create') }}" type="button"
                                   class="btn btn-outline-success float-right mb-2">Create Todo</a>
                                <table class="table table-bordered" id="todo_table">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Last Updated</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($todos as $todo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $todo->title }}</td>
                                            <td>
                                                {{ mb_strimwidth($todo->description, 0, 25, '...') }}
                                            </td>
                                            <td>
                                                <img src="{{asset('/storage/'. $todo->image)}}" width="100px">
                                            </td>
                                            <td>{{ $todo->updated_at->diffForHumans() }}</td>
                                            <td class="d-flex">
                                                <a class="btn btn-primary btn-sm mr-1"
                                                   href="{{ route('todos.show', $todo->id) }}">View</a>
                                                <a class="btn btn-dark btn-sm mr-1"
                                                   href="{{ route('todos.edit', $todo->id) }}">Edit</a>
                                                <form method="POST" action="{{ route('todos.destroy', $todo->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete
                                                    </button>
                                                </form>
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
    @section('third_party_stylesheets')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    @endsection
    @section('third_party_scripts')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('#todo_table').DataTable();
            } );
        </script>
    @endsection
@endsection
