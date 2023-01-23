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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                <a href="{{ route('todos.index') }}" type="button"
                                    class="btn btn-outline-success float-right mb-2">Go Back</a>
                                <form action="{{route('todos.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                            value="{{ old('title') }}">
                                        @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" rows="3" id="description" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="file-input">
                                            <img id="frame" src="{{asset('upload.png')}}" alt="" width="235px"
                                                 height="235px"></label>
                                        <input id="file-input" onchange="preview()" name="image"
                                               class="d-none form-control @error('image') is-invalid @enderror" type="file">
                                        @error('image')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Todo</button>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
    @section('third_party_scripts')
        <script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    @endsection
@endsection
