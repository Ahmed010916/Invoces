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
                    <h1 class="m-0">Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Setting</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    @permission('Product_create')
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default">
                            Create new Product
                        </button>
                        @endpermission
                    </div>
                    <div class="col-sm-6">
                        @if (session()->has('yes'))
                            <div class="alert alert-success" role="alert" style="opacity: 0.5">
                                {{ session()->get('yes') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @error('product_name')
                            <div class="alert alert-success" role="alert" style="opacity: 0.5">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        @error('section_id')
                            <div class="alert alert-success" role="alert" style="opacity: 0.5">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        @error('note')
                            <div class="alert alert-success" role="alert" style="opacity: 0.5">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Section Name</th>
                                <th scope="col">Note</th>
                                <th scope="col">created_by</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($products as $product)<?php $i++; ?>
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->section->section_name }}</td>
                                    <td>{{ $product->note }}</td>
                                    <td>{{ $product->created_by }}</td>
                                    <td>
                                        <div class="row">
                                            @permission('Product_edite')
                                            <input type="button" data-toggle="modal" data-target="#modal-defaultUpdata"
                                                onclick="add('{{ $product->product_name }}','{{ $product->note }}','{{ $product->id }}')"
                                                id="datainput1" data-section_name="cc" data-note="cc"
                                                class="btn btn-warning mx-3" value="Edite" />

                                            @endpermission
                                           @permission('Product_delete')
                                           <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                           @endpermission
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.modal-dialog -->
                @permission('Product_create')
                <div class="modal fade show" id="modal-default" style="display: none; padding-right: 17px;" aria-modal="true"
                    role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create New Product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('products.store') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="product_name" class="form-control"
                                            placeholder="Product Name">
                                    </div>

                                    <div class="input-group mb-3">
                                        <select name="section_id" class="form-control" required>
                                            <option selected disabled>...</option>
                                            @foreach ($createsections as $createsection)
                                                <option value="{{ $createsection->id }}">{{ $createsection->section_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" name="note" class="form-control" placeholder="note">
                                    </div>
                                    <input type="submit" class="btn btn-success" value="submit">
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endpermission
                <!-- /.modal-dialog  Updata -->
                <div class="modal fade show" id="modal-defaultUpdata" style="display: none; padding-right: 17px;"
                    aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> UpData Section </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('updatamy') }}" method="post">
                                    @method('put')
                                    @csrf

                                    <input type="hidden" id="id" value="" name="id">

                                    <div class="input-group mb-3">
                                        <input type="text" name="product_name" id="product_name" class="form-control"
                                            placeholder="Product Name">
                                    </div>
                                    <div class="input-group mb-3">
                                        <select name="section_id" class="form-control">
                                            <option selected disabled>...</option>
                                            @foreach ($createsections as $createsection)
                                                <option value="{{ $createsection->id }}">{{ $createsection->section_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="note" class="form-control" id="note" placeholder="note">
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Updata">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.content -->
    @endsection

@section('js')
    <script type="text/javascript">
        function add(a1, a2, a3) {
            document.getElementById("product_name").value = a1;
            document.getElementById("note").value = a2;
            document.getElementById("id").value = a3;
        }
    </script>
@stop
