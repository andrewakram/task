@extends('indexcp')
@section('all_employees')
<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{URL::to('all/employees')}}">
                        <h3 style="color:#0fb790;">All Employees</h3>
                    </a>
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
                        <div class="alert alert-success">
                            <ul>
                                {{session()->get('insert_message')}}
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company Name</th>
                            <th>Date Created</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($employees as $employee)
                        <tr style="background-color: {{$employee->deleted_at != null ? "#da5c68":""}}">
                            @if($employee->deleted_at == null)
                                <th><a href="{{URL::to('/edit/employee/'.$employee->e_id)}}" class="btn btn-info" style="padding: 1px 3px;"><i class="glyphicon glyphicon-edit"></i></a></th>
                                <th><a href="{{URL::to('/delete/employee/'.$employee->e_id)}}" class="btn btn-danger" id="deletes" style="padding: 1px 3px;"><i class="glyphicon glyphicon-trash"></i></a></th>
                            @else
                                <th></th>
                                <th></th>
                            @endif
                            <th>{{$employee->e_id}}</th>
                            <th>{{$employee->e_fname}}</th>
                            <th>{{$employee->e_lname}}</th>
                            <th>{{$employee->e_email}}</th>
                            <th>{{$employee->e_phone}}</th>
                            <th>{{$employee->c_name}}</th>
                            <th>{{$employee->created_at}}</th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-4 (nested) -->
    </div>
</div>
@endsection