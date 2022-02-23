@extends('layouts.master')

@section('css')
    <title>Ahmed System</title>

    <!-- Select2 plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css-->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">ReportInvoces</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        @if (session()->has('yes'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session()->get('yes') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="row">
                <a href="{{ url('/ReportsInvoces') }}" class="m-3 btn btn-dark" style="position: absolute">Refrach</a>
            </div>
            <form action="{{ route('ReportsInvoces.search') }}" method="POST">
                <div class="container" x-data="{open:false}">
                    <div class="card-header">
                        <form action="{{ route('ReportsInvoces.search') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input @change="open = false" value="data" name="invocesearch"
                                            class="form-check-input" type="radio" id="exampleRadios1" value="option1"
                                            checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Search By Invoces Data
                                        </label>
                                    </div><br>
                                    <div class="form-check">
                                        <input @change="open = true" value="number" name="invocesearch"
                                            class="form-check-input" type="radio" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Search By Invoces Number
                                        </label>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col" x-show="!open">
                                    <div class="form-group">
                                        <label for="inputGroupSelect01">Invoces</label>
                                        <div class="input-group mb-3">
                                            <select name="typesearch" class="custom-select" id="inputGroupSelect01">
                                                <option selected disabled>Choose...</option>
                                                <option value="all">All Invoces</option>
                                                <option value="1">paid Invoces</option>
                                                <option value="2">Unpaid Invoces</option>
                                                <option value="3">part paid Invoces</option>
                                            </select>
                                            {{-- {!! Form::select("typesearch", [1,2,3,4], old('typesearch'), ['All Invoces','paid Invoces','Unpaid Invoces','part paid Invoces']) !!} --}} @error('typesearch')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col" x-show="!open">
                                    <div class="form-group">
                                        <label>StartData</label>
                                        <div class="input-group date">
                                            <input name="startdata" type="date" class="form-control">
                                        </div>
                                        @error('startdata')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- //invoces Number --}}
                                <div class="col" x-show="open">
                                    <div class="form-group">
                                        <label for="Invoces">Invoces Number</label>
                                        <div class="input-group date" id="Invoces">
                                            <input name="invocesnumber" type="text" class="form-control"
                                                placeholder="Invoces Number">
                                        </div>
                                        @error('invocesnumber')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- //end invoces Number --}}

                                <div class="col" x-show="!open">
                                    <div class="form-group">
                                        <label>EndDate</label>
                                        <div class="input-group date">
                                            <input name="enddata" type="date" class="form-control">
                                        </div>
                                        @error('enddata')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col"
                                    style="display: flex; justify-content: center;align-items: end;">
                                    <div class="form-group">
                                        <button class="btn btn-dark" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                      @isset ($invoces)
                        @permission('export_invoces')
                        <div class="">
                            <a href="http://127.0.0.1:8000/invocesReportsExport/1">Export Invoces</a>
                            {{-- <form action="invocesReportsExport/{{ $invoces }}" method="POST">
                                <button  class="btn btn-dark" type="submit">Export Invoces</button>
                            </form> --}}
                        </div>
                        @endpermission
                      @endisset
                    </div>
                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @isset($invoces)
                                @foreach ($invoces as $invoce)@php $i = $i + 1; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a
                                                href="{{ route('invoces-ditalis.edit', $invoce->id) }}">{{ $invoce->invoces_number }}</a>
                                        </td>
                                        <td>{{ $invoce->invoces_data }}</td>
                                        <td>{{ $invoce->due_data }}</td>
                                        <td>{{ $invoce->section->section_name }}</td>
                                        <td>{{ $invoce->product->product_name }}</td>
                                        <td>{{ $invoce->price_collection }}</td>
                                        <td>{{ $invoce->Price_Commission }}</td>
                                        <td>{{ $invoce->discount }}</td>
                                        <td>{{ $invoce->rote_vat }}%</td>
                                        <td>{{ $invoce->value_vat }}</td>
                                        <td>{{ $invoce->total }}</td>
                                        <td>
                                            @if ($invoce->values_status == 1) <span class="badge badge-primary">{{ $invoce->status }}</span>  @endif
                                            @if ($invoce->values_status == 3) <span class="badge badge-danger">{{ $invoce->status }}</span>  @endif
                                            @if ($invoce->values_status == 2) <span class="badge badge-warning">{{ $invoce->status }}</span>  @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                            @isset($invoces)
                                <tr style="text-align: center">
                                   <td colspan="13"> @if ($invoces->count() <= 0)
                                    <h3>No Data</h3>
                                @endif</td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
        </div>
    </div><!-- /.content -->
@endsection

@section('js')

@endsection
