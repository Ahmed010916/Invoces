@extends('layouts.master')

@section('css')
    <title> Invoces list </title>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoces</h1>
                    <a href="{{route("invoces.index")}}" class="btn btn-primary">Back To Invoces</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Setting</a></li>
                        <li class="breadcrumb-item active">Invoces Trashed</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if(session()->has('yes'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                       {{session()->get('yes')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoces list</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark ">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Invoces Number</th>
                            <th>Invoces Data</th>
                            <th>Due Data</th>
                            <th>Section</th>
                            <th>Product</th>
                            <th>Price Collection</th>
                            <th>Price Commission</th>
                            <th>Discount</th>
                            <th>rote_vat</th>
                            <th>value_vat</th>
                            <th>total</th>
                            <th>status</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                            @foreach($invoces as $invoce)@php $i = $i + 1; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="{{route('invoces-ditalis.edit',$invoce->id)}}">{{$invoce->invoces_number}}</a></td>
                                <td>{{$invoce->invoces_data}}</td>
                                <td>{{$invoce->due_data}}</td>
                                <td>{{$invoce->section->section_name}}</td>
                                <td>{{$invoce->product->product_name}}</td>
                                <td>{{$invoce->price_collection}}</td>
                                <td>{{$invoce->Price_Commission}}</td>
                                <td>{{$invoce->discount}}</td>
                                <td>{{$invoce->rote_vat}}%</td>
                                <td>{{$invoce->value_vat}}</td>
                                <td>{{$invoce->total}}</td>
                                <td>
                                    @if($invoce->values_status == 1) <span class="badge badge-primary">{{$invoce->status}}</span>  @endif
                                    @if($invoce->values_status == 2) <span class="badge badge-danger">{{$invoce->status}}</span>  @endif
                                    @if($invoce->values_status == 3) <span class="badge badge-warning">{{$invoce->status}}</span>  @endif
                                </td>
                                <td colspan="2">
                                    <div class="dropdown" style="width: 50px">
                                        <button style="width: 50px" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            links
                                        </button>
                                        <div style="width: 50px" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" class="btn btn-outline-primary" href="{{route('invoces-ditalis.edit',$invoce->id)}}">Show</a>
                                            @permission('edite_invoces')
                                            <a class="dropdown-item" class="btn btn-outline-primary" href="{{route('invoces.edit',[$invoce->id])}}">Edite</a>
                                            @endpermission
                                            <div class="dropdown-item">
                                                <form action="{{route('Untrachedinvoces',[$invoce->id])}}" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">ToInvoces</button>
                                                </form>
                                            </div>
                                            @permission('delete_invoces')
                                            <div class="dropdown-item">
                                                <form action="{{route('invoces.destroy',[$invoce->id])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                            @endpermission
                                            <a class="dropdown-item" href="{{route('statusEdite',[$invoce->id])}}" class="btn btn-warning">Status Edite</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $invoces !!}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div><!-- /.content -->
@endsection
