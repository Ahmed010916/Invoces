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
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                @permission('Users_create')
                    <a href="{{ route('Users.create') }}" class="m-1 btn btn-primary">Create User</a>
                @endpermission
            </div>
            <div class="row">
                <div class="col">
                    @permission('Invoces')
                        <table class="table">
                            <thead class="table-bordered thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">@php $i = 0; @endphp
                                @foreach ($users as $user)
                                    @if ($user->email == Auth()->user()->email)
                                        <tr>
                                            @php $i++; @endphp
                                            <th class="bg-dark" scope="row">{{ $i }}</th>
                                            <td class="bg-dark">{{ $user->name }}</td>
                                            <td class="bg-dark">{{ $user->email }}</td>
                                            <td class="bg-dark">
                                                @if ($user->state == 1)
                                                    <p class="badge bg-success">Active</p>
                                                @elseif ($user->state == 0)
                                                    <p class="badge bg-warning">Disable</p>
                                                @endif
                                            </td>
                                            <td class="bg-dark">{{ $user->created_at }}</td>
                                            <td class="bg-dark">
                                                @foreach ($user->roles as $role)
                                                    <p class="badge bg-success"> {{ $role->name }}</p>
                                                @endforeach
                                            </td>
                                            <td class=" bg-dark">

                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            @php $i++; @endphp
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->state == 1)
                                                    <p class="badge bg-success">Active</p>
                                                @elseif ($user->state == 0)
                                                    <p class="badge bg-warning">Disable</p>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <p class="badge bg-success"> {{ $role->name }}</p>
                                                @endforeach
                                            </td>
                                            <td class="d-flex">
                                                @permission('Users_edite')
                                                    <a href="{{ route('Users.edit', $user->id) }}"
                                                        class="mx-1 btn btn-warning">Edite</a>
                                                @endpermission
                                                @permission('Users_delete')
                                                    <form action="{{ route('Users.destroy', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger " type="submit">Delete</button>
                                                    </form>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endpermission
                </div>
            </div>
        </div>
    </div><!-- /.content -->
@endsection
