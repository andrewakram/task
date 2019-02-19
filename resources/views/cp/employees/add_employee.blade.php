@extends('indexcp')
@section('add_employee')
    <div id="page-wrapper">
        <br>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="color:#449D44;">Add New Employee</h3>
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
                    <form role="form" method="post" enctype="multipart/form-data" action="{{url('/add/new/employee')}}" >
                    {{csrf_field()}}
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group  col-lg-6 col-lg-offset-3">
                                    <label>Company</label>
                                    <select name="company" id="selectMainService" class="form-control select2" style="width: 100%;">
                                        <option value="" disabled selected>Choose Company Name</option>
                                        @foreach($companies as $c)
                                            <option value="{{$c->c_id}}" >{{$c->c_name}}</option>
                                        @endforeach
                                    </select><hr>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>First Name</label>
                                    <input name="e_fname" type="text" required class="form-control" placeholder="Enter First Name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Last Name</label>
                                    <input name="e_lname" type="text"  required class="form-control" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone</label>
                                    <input name="e_phone" type="number"class="form-control" placeholder="Enter Phone">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email</label>
                                    <input name="e_email" type="email" class="form-control" placeholder="Enter Email">
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