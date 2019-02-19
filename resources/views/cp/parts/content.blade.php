@extends('indexcp')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="color:#0fb790;">Dashboard</h1>
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
                <div class="alert alert-danger">
                    <ul>
                        {{session()->get('insert_message')}}
                    </ul>
                </div>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        {{--<div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                @if(Session::get('subadmin') == "0")
                                    {{sizeof(DB::table('comments')->where('deleted_at','=',NULL)->get())}}
                                @else
                                    {{sizeof(DB::table('comments')
                                        ->join('bookings','bookings.b_id_generator','comments.book_id')
                                        ->join('companies','companies.c_id','bookings.company_id')
                                        ->join('subadmins','subadmins.company_id','companies.c_id')
                                        ->where('subadmins.s_a_email','=',Session::get('a_email'))
                                        ->where('comments.deleted_at','=',NULL)->get())}}
                                @endif
                            </div>
                            <div>Comments!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/comments')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>--}}

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{sizeof(DB::table('companies')->where('deleted_at','=',NULL)->get())}}</div>
                            <div>Companies!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/companies')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        {{--
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{sizeof(DB::table('bookings')->where('deleted_at','=',NULL)->get())}}</div>
                            <div>Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/bookings')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-group fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{sizeof(DB::table('users')->where('deleted_at','=',NULL)->get())}}</div>
                            <div>Users!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/users')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-star-half-full fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                @if(Session::get('subadmin') == "0")
                                    {{sizeof(DB::table('ratings')->where('deleted_at','=',NULL)->get())}}
                                @else
                                    {{sizeof(DB::table('ratings')
                                        ->join('bookings','bookings.b_id_generator','ratings.book_id')
                                        ->join('companies','companies.c_id','bookings.company_id')
                                        ->join('subadmins','subadmins.company_id','companies.c_id')
                                        ->where('subadmins.s_a_email','=',Session::get('a_email'))
                                        ->where('ratings.deleted_at','=',NULL)->get())}}
                                @endif
                            </div>
                            <div>Rates!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/ratings')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-th fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                @if(Session::get('subadmin') == "0")
                                    {{sizeof(DB::table('services')->where('deleted_at','=',NULL)->get())}}
                                @else
                                    {{sizeof(DB::table('services')
                                        ->join('servicedetails','servicedetails.service_id','services.s_id')
                                        ->join('companies','companies.c_id','servicedetails.company_id')
                                        ->join('subadmins','subadmins.company_id','companies.c_id')
                                        ->where('subadmins.s_a_email','=',Session::get('a_email'))
                                        ->where('services.deleted_at','=',NULL)->get())}}
                                @endif
                            </div>
                            <div>Services!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/services')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-puzzle-piece fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                @if(Session::get('subadmin') == "0")
                                    {{sizeof(DB::table('offers')->where('deleted_at','=',NULL)->get())}}
                                @else
                                    {{sizeof(DB::table('offers')
                                        ->join('companies','companies.c_id','offers.company_id')
                                        ->join('subadmins','subadmins.company_id','companies.c_id')
                                        ->where('subadmins.s_a_email','=',Session::get('a_email'))
                                        ->where('offers.deleted_at','=',NULL)->get())}}
                                @endif
                            </div>
                            <div>offers!</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('all/offers')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        --}}

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@endsection