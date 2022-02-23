@extends('layouts.master')

@section('css')
    <title>Ahmed System</title>
    <style>
        @media print {
            .noprint{
                display: none;
            }
            .main-footer{
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $invoces->invoces_number }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Print</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="invoice p-3 mb-3 print" id='print'>
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> AdminLTE, Inc.
                      <small class="float-right">Date: 2/10/2014</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    From
                    <address>
                      <strong>{{ Auth::user()->name }}</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      San Francisco, CA 94107<br>
                      <strong>Phone:</strong> (804) 123-5432<br>
                      <strong>Email:</strong>  {{ Auth::user()->email }}<br>
                      <strong>WebSite:</strong> website.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    {{-- To
                    <address>
                      <strong>John Doe</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      San Francisco, CA 94107<br>
                      Phone: (555) 539-1037<br>
                      Email: john.doe@example.com
                    </address> --}}
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Invoice </b>{{ $invoces->invoces_number }}<br>
                    <br>
                    <b>Invoces Data</b> {{ $invoces->invoces_data }}<br>
                    <b>Payment Due:</b> {{ $invoces->due_data }}<br>
                    <b>Status:</b>
                        @if ($invoces->values_status == 1)
                            <span class="badge badge-success">{{ $invoces->status }}</span>
                        @elseif ($invoces->values_status == 2)
                            <span class="badge badge-danger">{{ $invoces->status }}</span>
                        @elseif ($invoces->values_status == 3)
                            <span class="badge badge-warning">{{ $invoces->status }}</span>
                        @endif
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row mb-5">

                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  {{-- <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                      plugg
                      dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                  </div> --}}
                  <!-- /.col -->
                  <div class="col-12">
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>invoces_data : {{ $invoces->invoces_data }}</td>
                                    <td>due_data: {{ $invoces->due_data }}</td>
                                    <td colspan="2"> price_collection :{{ $invoces->price_collection }}</td>
                                </tr>
                                <tr>
                                    <td> Price_Commission: {{ $invoces->Price_Commission }}</td>
                                    <td>Discount:  {{ $invoces->discount}}</td>
                                    <td>rote_vat:  {{ $invoces->rote_vat}}%</td>
                                    <td>value_vat:  {{ $invoces->value_vat }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Section: {{ $invoces->section->section_name }}</td>
                                    <td colspan="2">Product: {{ $invoces->product->product_name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">total : {{ $invoces->total }}</td>
                                    <td colspan="2">status :  @if ($invoces->values_status == 1)
                                        <span class="badge badge-success">{{ $invoces->status }}</span>
                                    @elseif ($invoces->values_status == 2)
                                        <span class="badge badge-danger">{{ $invoces->status }}</span>
                                    @elseif ($invoces->values_status == 3)
                                        <span class="badge badge-warning">{{ $invoces->status }}</span>
                                    @endif</td>
                                </tr>
                                </tbody>
                        </table>
                      </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary" style="margin-right: 5px;" onclick="var print = document.getElementById('print').innerHTML;print = window.print();">
                      <i class="fas fa-download"></i> Print
                    </button>
                  </div>
                </div>
              </div>
        </div>
    </div><!-- /.content -->
@endsection
@section('js')

@endsection

