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
                    <h1 class="m-0">Section</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Setting</a></li>
                        <li class="breadcrumb-item active">Section</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    @permission('Section_create')
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default">
                            Create Section
                        </button>
                     @endpermission
                </div>
                <div class="col-sm-6">
                   @if(session()->has('yes'))
                        <div class="alert alert-success" role="alert" style="opacity: 0.5">
                           {{session()->get('yes')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                    @error('section_name')
                       <div class="alert alert-success" role="alert" style="opacity: 0.5">
                           {{$message}}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                    @enderror
                       @error('note')
                           <div class="alert alert-success" role="alert" style="opacity: 0.5">
                               {{$message}}
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
                        <th scope="col">Section Name</th>
                        <th scope="col">Note</th>
                        <th scope="col">created_by</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($sections as $section)  <?php $i = $i + 1 ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$section->section_name}}</td>
                                <td>{{$section->note}}</td>
                                <td>{{$section->created_by}}</td>
                                <td>
                                    <div class="row">
                                        @permission('Section_edite')
                                        <input type="button" data-toggle="modal" data-target="#modal-defaultUpdata" onclick="add('{{$section->section_name}}','{{$section->note}}','{{$section->id}}')" id="datainput1" data-section_name="{{$section->section_name}}" data-note="{{$section->note}}" class="btn btn-warning mx-3" value="Edite"/>
                                        @endpermission

                                        @permission('Section_delete')
                                        <form action="{{route('section.destroy',$section->id)}}" method="post">
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

                <div>{!! $sections->links() !!}</div>
            </div>
            <!-- /.modal-dialog -->
            <div class="modal fade show" id="modal-default" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Default Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('section.store')}}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="section_name" class="form-control" placeholder="Section Name">
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
            <!-- /.modal-dialog  Updata -->
            <div class="modal fade show" id="modal-defaultUpdata" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"> UpData Section </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('section.update',2)}}" method="post">
                                @method('put')
                                @csrf
                                <input type="hidden" id="upp" name="id" >
                                <div class="input-group mb-3">
                                    <input type="text" name="section_name" id="section_nameup" class="form-control" placeholder="Section Name">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" id="noteup" name="note" class="form-control" placeholder="note">
                                </div>

                                <div class="form-check">
                                    <input name="check" value="yes" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        if you went Edite Or update Section Name plese checkbox This True
                                    </label>
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
        function add(a1 = "",a2 = "",a3 = "") {
            document.getElementById("section_nameup").value = a1;
            document.getElementById("noteup").value = a2;
            document.getElementById("upp").value = a3;
        }
    </script>
@stop
