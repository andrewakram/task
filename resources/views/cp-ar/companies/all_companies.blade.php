@extends('indexcp-ar')
@section('all_companies_ar')
<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{URL::to('ar/all/companies')}}">
                        <h3 style="color:#0fb790;">كل الشركات</h3>
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
                            <th>الاسم</th>
                            <th>الصورة</th>
                            <th>البريد الالكتروني</th>
                            <th>رابط الموقع</th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($companies as $company)
                            <tr style="background-color: {{$company->deleted_at != null ? "#da5c68":""}}">
                                @if($company->deleted_at == null)
                                    <th><a href="{{URL::to('/ar/edit/company/'.$company->c_id)}}" class="btn btn-info" style="padding: 1px 3px;"><i class="fas fa-edit"></i></a></th>
                                    <th><a href="{{URL::to('/ar/delete/company/'.$company->c_id)}}" class="btn btn-danger" id="deletes" style="padding: 1px 3px;"><i class="fas fa-trash-alt"></i></a></th>
                                @else
                                    <th></th>
                                    <th></th>
                                @endif
                                <th>{{$company->c_id}}</th>
                                <th>{{$company->c_name}}</th>
                                @if($company->c_logo != NULL)
                                    <th><img src="{{URL::to('/storage/company_logos/'.$company->c_logo)}}" alt="{{$company->c_logo}}" width="40px" height="40px"></th>
                                @else
                                    <th> - </th>
                                @endif
                                <th>{{$company->c_email}}</th>
                                <th>{{$company->c_website}}</th>
                                <th>{{$company->created_at}}</th>
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