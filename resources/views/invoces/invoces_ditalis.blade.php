@extends('layouts.master')

@section('css')
    <title>Ahmed System</title>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @if(session()->has('yes'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{session()->get('yes')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoces Number: {{$invoces->invoces_number}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoces Ditalis</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container ">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Invoces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ditalis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Attachments</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>invoces_data : {{$invoces->invoces_data}}</td>
                            <td>due_data: {{$invoces->due_data}}</td>
                            <td colspan="2"> price_collection :{{$invoces->price_collection}}</td>
                        </tr>
                        <tr>
                            <td> Price_Commission: {{$invoces->Price_Commission}}</td>
                            <td>Discount: {{$invoces->discount}}</td>
                            <td>rote_vat: {{$invoces->rote_vat}}%</td>
                            <td>value_vat: {{$invoces->value_vat}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Section: {{$invoces->section->section_name}}</td>
                            <td colspan="2">Product: {{$invoces->product->product_name}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">total :{{$invoces->total}}</td>
                            <td colspan="2">status :{{$invoces->status}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('invoces_print',$invoces->id)}}" class="btn btn-dark">Print</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">State</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                        </tr>
                        </thead>
                        <tbody><?php $i=0; ?>
                           @foreach($invoces_ditalis as $x )<?php $i++; ?>
                               <tr>
                                   <td>{{$i}}</td>
                                   <td>
                                       @if($x->value_state == 1)
                                        <span class="badge badge-success">{{$x->state}}</span>
                                       @elseif($x->value_state == 2)
                                           <span class="badge badge-danger">{{$x->state}}</span>
                                       @else
                                           <span class="badge badge-warning">{{$x->state}}</span>
                                       @endif
                                   </td>
                                   <td>{{$x->Created_by}}</td>
                                   <td>{{$x->created_at}}</td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <form action="{{route('AddfileAttachment',[$invoces->invoces_number,$invoces->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Add File</label>
                            <input name="file_Attach" type="file" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </form>
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">file_name</th>
                            <th scope="col">file_path</th>
                            <th scope="col">file_type</th>
                            <th scope="col">upload At</th>
                            <th scope="col">Events</th>
                        </tr>
                        </thead>
                        <tbody><?php $i=0; ?>
                        @foreach($invoces_attachments as $a )<?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$a->file_name}}</td>
                            <td>{{$a->file_path}}</td>
                            <td>{{$a->file_type}}</td>
                            <td>{{$x->created_at}}</td>
                            <td>
                                <form target="_blank" action="{{route('viewfile',[$invoces->invoces_number,$a->file_name])}}" method="post">
                                    @csrf
                                    <button class="badge badge-primary"  type="submit">View</button>
                                </form>
                                <form  action="{{route('dawnfile',[$invoces->invoces_number,$a->file_name])}}" method="post">
                                    @csrf
                                    <button class="badge badge-success" type="submit">Dawnlode</button>
                                </form><form  action="{{route('deletefile',[$invoces->invoces_number,$a->file_name,$a->id])}}" method="post">
                                    @csrf
                                    <button class="badge badge-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.content -->
@endsection
