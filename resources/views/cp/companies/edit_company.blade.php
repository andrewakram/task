@extends('indexcp')
@section('edit_company')
    @foreach ($companies as $company)
    <div id="page-wrapper">
        <br>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Edit Company: <b style="color:#31B0D5;"># {{ Route::input('c_id') }}</b></h3>
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
                    <form role="form" method="post" enctype="multipart/form-data" action="{{url('/update/company/'.$company->c_id)}}" >
                        {{csrf_field()}}
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <label>Name</label>
                                        <input name="c_name" value="{{$company->c_name}}" type="text" required class="form-control" placeholder="Enter Company Name">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Email</label>
                                        <input name="c_email" value="{{$company->c_email}}" type="text" class="form-control" placeholder="Enter Company Email">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Website URL</label>
                                        <input name="c_website" value="{{$company->c_website}}" type="text" class="form-control" placeholder="Enter Company Website URL">
                                    </div>
                                    <div class="form-group col-lg-1">
                                        @if($company->c_logo != NULL)
                                            <img src="{{URL::to('/storage/company_logos/'.$company->c_logo)}}" alt="{{$company->c_logo}}" width="80px" height="80px">
                                        @else
                                            <br><br>
                                            <small> No Image Found </small>
                                        @endif
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Choose Company Logo</label>
                                        <input name="c_logo" type="file" class="form-control">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <button type="submit" class="btn btn-info col-lg-12">Update</button>
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
    @endforeach
@endsection