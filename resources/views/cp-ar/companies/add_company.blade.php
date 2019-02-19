@extends('indexcp-ar')
@section('add_company_ar')
    <div id="page-wrapper">
        <br>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="color:#449D44;">اضافة شركة جديدة</h3>
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
                                    <label>الاسم</label>
                                    <input name="c_name" type="text" required class="form-control" placeholder="ادخل اسم الشركة">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>البريد الالكتروني</label>
                                    <input name="c_email" type="text" class="form-control" placeholder="ادخل البريد الالكتروني">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>رابط الموقع</label>
                                    <input name="c_website" type="text" class="form-control" placeholder="ادخل رابط الموقع">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>اختر صورة للشركة</label>
                                    <input name="c_logo" type="file" class="form-control">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <button type="submit" class="btn btn-success col-lg-12">حفظ</button>
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