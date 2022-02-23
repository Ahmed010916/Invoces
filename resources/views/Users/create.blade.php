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
                    <h1 class="m-0">Create User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                <a href="{{ route('Users.index') }}" class="m-1 btn btn-primary">Back</a>
            </div>
            <form action="{{ route('Users.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="text">User Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="text">
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}"  class="form-control" id="email">
                        @error('email')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pass">Password</label>
                        <input name="password" type="password" class="form-control" id="pass">
                        @error('password')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="c-pass">Confirm Password</label>
                        <input name="confirm_password" type="password" class="form-control" id="c-pass" autocomplete="new-password">
                        @if (session()->has('confirm_password'))
                            <p class="text-danger"> {{ session()->get('confirm_password') }}</p>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="inputState">Roles</label>
                        <select name="Role" id="inputState" class="form-control">
                            <option selected disabled>Choose...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('Role')<p class="text-danger">{{ $message }}</p>@enderror
                        @if ($roles->count() <= 0)
                            <p class="text-danger">No Roles Please create New Roles <a
                                    href="{{ route('Roles.index') }}">Click Here</a></p>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">States</label>
                        <select name="state" id="inputState" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Disable</option>

                        </select>
                        @error('state')<p class="text-danger">{{ $message }}</p>@enderror
                        @if ($roles->count() <= 0)
                            <p class="text-danger">No Roles Please create New Roles <a
                                    href="{{ route('Roles.index') }}">Click Here</a></p>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div><!-- /.content -->
@endsection
