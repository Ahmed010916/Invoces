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
                        <li class="breadcrumb-item active">Invoces list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{route('invoces.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row"  x-data='{tax:0,discount:0,Price_Commission:0}'>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices number</label>
                                <input name="invoces_number" type="text"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices Date</label>
                                <input name="invoces_data" type="date"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoices due date</label>
                                <input name="due_data" type="date"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100" x-data="{
                        idsection: '',
                        products: {},
                            async sendid() {
                                this.products = await (await fetch('http://127.0.0.1:8000/sectionss_get/'+ this.idsection)).json();

                                console.log(this.products);
                            }
                        }">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Section</label>
                                <select name="section" @change="sendid" x-model="idsection" class="custom-select" >
                                    <option selected> select section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @endforeach
                                </select>
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col"  style="display: grid;align-items: end;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product</label>
                                <select name="product" class="custom-select">
                                    <option selected>select product</option>
                                    <template style="width: 0;margin: 0;padding: 0;border: 0;display: none" x-for="product in products">
                                        <option x-model="product.id" x-text="product.product_name"></option>
                                    </template>
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Collection</label>
                                <input name="price_collection"  type="text"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Commission</label>
                                <input name="Price_Commission" type="text" x-model="Price_Commission" id="Price_Commission" class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount</label>
                                <input name="discount" type="text" x-model="discount" id="discount" class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">%tax</label>
                                <select name="rote_vat" id="inputState" x-model="tax" class="form-control">
                                    <option selected>Choose...</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price value tax</label>
                                <input name="value_vat"  type="text" x-model="(Price_Commission - discount)*tax/100" id="Pricevaluetax" class="form-control" readonly>
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Commission total + tax</label>
                                <input name="total" type="text" x-model="((Price_Commission - discount)*tax/100)+(Price_Commission - discount)" id="Pricetotal_tax" class="form-control" readonly>
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nots</label>
                                <input name="note"  type="text"  class="form-control"  >
                                {{--<small class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Attachments</label>
                                <small class="form-text font-weight-bold" style="color:red "> Uplode file only PDF, image:jpg,pag,jpeg</small>
                                <input name="inv" type="file"  class="form-control"  >
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
