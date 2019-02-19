@extends('indexcp-ar')
@section('all_employees_ar')
<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{URL::to('ar/all/employees')}}">
                        <h3 style="color:#0fb790;">الموظفيين</h3>
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
                            <th>تعديل</th>
                            <th>مسح</th>
                            <th>#</th>
                            <th>الاسم الاول</th>
                            <th>الاسم الاخير</th>
                            <th>البريد الالكتروني</th>
                            <th>التليفون </th>
                            <th>اسم الشركة </th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($employees as $employee)
                            <tr style="background-color: {{$employee->deleted_at != null ? "#da5c68":""}}">
                                @if($employee->deleted_at == null)
                                    <th><a href="{{URL::to('/ar/edit/employee/'.$employee->e_id)}}" class="btn btn-info" style="padding: 1px 3px;"><i class="fas fa-edit"></i></a></th>
                                    <th><a href="{{URL::to('/ar/delete/employee/'.$employee->e_id)}}" class="btn btn-danger" id="deletes" style="padding: 1px 3px;"><i class="fas fa-trash-alt"></i></a></th>
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