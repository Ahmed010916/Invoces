@extends('layouts.master')

@section('css')
    <title> Create new invoces </title>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{route("invoces.index")}}" class="btn btn-primary">Back to list invoces</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invoces</a></li>
                        <li class="breadcrumb-item active">Invoces Updata</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
                <div class="row"  x-data='{tax:{{$invoces->rote_vat}},discount:{{$invoces->discount}},Price_Commission:{{$invoces->Price_Commission}}}'>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices number</label>
                                <input disabled value="{{$invoces->invoces_number}}" type="text"  class="form-control"  >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices Date</label>
                                <input disabled  name="invoces_data" type="date"  value="{{$invoces->invoces_data}}"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices due date</label>
                                <input  disabled name="due_data" type="date"  value="{{$invoces->due_data}}"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Section</label>
                                <select disabled  name="section" class="custom-select" >
                                    <option selected value="{{$invoces->section->id}}" >{{$invoces->section->section_name}}</option>
                                </select>
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col"  style="display: grid;align-items: end;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product</label>
                                <select disabled  name="product" class="custom-select">
                                    <option selected value="{{$invoces->product->id}}" >{{$invoces->product->product_name}}</option>
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Collection</label>
                                <input  disabled name="price_collection"  value="{{$invoces->price_collection}}" type="text"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Commission</label>
                                <input  disabled name="Price_Commission" value="{{$invoces->Price_Commission}}"   type="text" class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount</label>
                                <input disabled name="discount" type="text" value="{{$invoces->discount}}" class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">%tax</label>
                                <select disabled name="rote_vat" id="inputState" x-model="tax" class="form-control">
                                    <option value="{{$invoces->rote_vat}}">{{$invoces->rote_vat}}%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price value tax</label>
                                <input disabled name="value_vat" value="{{$invoces->value_vat}}"  type="text" id="Pricevaluetax" class="form-control" >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Commission total + tax</label>
                                <input disabled  disabled name="total" type="text"  value="{{$invoces->total}}"class="form-control">
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nots</label>
                                <input disabled name="note"  type="text"  value="{{$invoces->note}}"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
            <form action="{{route('statusUpdate',$invoces->id)}}" method="post">
                @csrf
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="custom-select" >
                                    <option selected value="1" >Paid</option>
                                    <option value="3">PartPaid</option>
                                    <option value="2">UnPaid</option>
                                </select>
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">dataPayment</label>
                                <input name="dataPayment" type="date" value="{{date('Y-m-d')}}"class="form-control">
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button class="btn btn-outline-primary"  type="submit">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.content -->
@endsection
@section('js')
    <script src="{{asset("dist/js/cdn.min.js")}}" defer></script>
@stop
