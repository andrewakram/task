@extends('indexcp')
@section('add_company')
    <div id="page-wrapper">
        <br>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="color:#449D44;">Add New Company</h3>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('insert_message'))
                            <hr>
                            {{session()->get('insert_message')}}
                            <hr>
                        @endif
                    </div>
                    <div class="panel-body">
                    <form role="form" method="post" enctype="multipart/form-data" action="{{url('/add/new/company')}}" >
                    {{csrf_field()}}
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-6">
                                    <label>Name</label>
                                    <input name="c_name" type="text" required class="form-control" placeholder="Enter Company Name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email</label>
                                    <input name="c_email" type="text" class="form-control" placeholder="Enter Company email">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Website URL</label>
                                    <input name="c_website" type="text" class="form-control" placeholder="Enter Company website">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Choose Company Logo</label>
                                    <input name="c_logo" type="file" class="form-control">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <button type="submit" class="btn btn-success col-lg-12">Save</button>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                    </form>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection