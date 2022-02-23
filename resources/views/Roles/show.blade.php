@extends('layouts.master')

@section('css')
    <title>Ahmed System</title>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Roles</a></li>
                        <li class="breadcrumb-item active">Show Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <a href="{{ route('Roles.index') }}" class="m-1 btn btn-primary">Back</a>
            </div>
            <div class="container">
                <div class="col">
                        <div class="form-group" style="max-width: 500px;">
                            <label for="text">Role Name</label>
                            <input disabled name="name" value="{{ $role->name }}" type="text" class="form-control" id="text">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group" style="max-width: 500px;">
                            <label for="description">Role description</label>
                            <input disabled  name="description" value="{{ $role->description }}" type="text" class="form-control" id="description">
                            @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="row m-3">
                            @foreach ($prem as $pre)
                                <div class="custom-control custom-checkbox m-3">
                                    <input disabled name="permissions[]" @foreach($role->permissions as $pm) @if ($pm->id == $pre->id) checked @endif @endforeach
                                        value="{{ $pre->id }}" type="checkbox" class="custom-control-input" id="{{ $pre->name }}">
                                    <label class="custom-control-label" for="{{ $pre->name }}">{{ $pre->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div><!-- /.content -->
@endsection
