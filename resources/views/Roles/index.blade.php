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
                    <h1 class="m-0">Empty</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Empty</li>
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
              @permission('Roles_create')
              <a href="{{ route('Roles.create') }}" class="m-1 btn btn-primary">Create Role</a>
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
                                    <th scope="col">Description</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">@php $i = 0; @endphp
                                @foreach ($roles as $role)
                                    @if (Auth()->user()->roles[0]->name == $role->name)
                                        <tr>
                                            @php $i++; @endphp
                                            <th class="bg-dark" scope="row">{{ $i }}</th>
                                            <td class="bg-dark">{{ $role->name }}</td>
                                            <td class="bg-dark">{{ $role->description }}</td>
                                            <td class="bg-dark">{{ date($role->created_at) }}</td>
                                            <td class="bg-dark"> </td>
                                        </tr>
                                    @else
                                        <tr>
                                            @php $i++; @endphp
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>{{ date($role->created_at) }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('Roles.show', $role->id) }}"
                                                    class="mx-1 btn btn-primary">Show</a>

                                                @permission('Roles_edite')
                                                <a href="{{ route('Roles.edit', $role->id) }}"
                                                    class="mx-1 btn btn-warning">Edite</a>
                                                @endpermission
                                                @permission('Roles_delete')
                                                <form action="{{ route('Roles.destroy', $role->id) }}" method="post">
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
        </div><!-- /.content -->
    @endsection
