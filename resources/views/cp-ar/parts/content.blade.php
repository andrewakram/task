@extends('indexcp-ar')
@section('content_ar')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:#0fb790;">لوحة التحكم</h1>
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
                            <div class="col-xs-4">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">
                                    @if(Session::get('subadmin') == "0")
                                        {{sizeof(DB::table('comments_ar')->where('deleted_at','=',NULL)->get())}}
                                    @else
                                        {{sizeof(DB::table('comments_ar')
                                            ->join('bookings_ar','bookings_ar.b_id_generator','comments_ar.book_id')
                                            ->join('companies_ar','companies_ar.c_id','bookings_ar.company_id')
                                            ->join('subadmins_ar','subadmins_ar.company_id','companies_ar.c_id')
                                            ->where('subadmins_ar.s_a_email','=',Session::get('a_email'))
                                            ->where('comments_ar.deleted_at','=',NULL)->get())}}
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">التعليقات!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/comments')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>--}}

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">{{sizeof(DB::table('companies_ar')->where('deleted_at','=',NULL)->get())}}</div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">الشركات!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/companies')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            {{--<div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">{{sizeof(DB::table('bookings_ar')->where('deleted_at','=',NULL)->get())}}</div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">الطلبات!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/bookings')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fas fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">{{sizeof(DB::table('users')->where('deleted_at','=',NULL)->get())}}</div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">العملاء!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/users')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fas fa-star-half-alt fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">
                                    @if(Session::get('subadmin') == "0")
                                        {{sizeof(DB::table('ratings_ar')->where('deleted_at','=',NULL)->get())}}
                                    @else
                                        {{sizeof(DB::table('ratings_ar')
                                            ->join('bookings_ar','bookings_ar.b_id_generator','ratings_ar.book_id')
                                            ->join('companies_ar','companies_ar.c_id','bookings_ar.company_id')
                                            ->join('subadmins_ar','subadmins_ar.company_id','companies_ar.c_id')
                                            ->where('subadmins_ar.s_a_email','=',Session::get('a_email'))
                                            ->where('ratings_ar.deleted_at','=',NULL)->get())}}
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">التقييمات!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/ratings')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-th fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">
                                    @if(Session::get('subadmin') == "0")
                                        {{sizeof(DB::table('services_ar')->where('deleted_at','=',NULL)->get())}}
                                    @else
                                        {{sizeof(DB::table('services_ar')
                                            ->join('servicedetails_ar','servicedetails_ar.service_id','services_ar.s_id')
                                            ->join('companies_ar','companies_ar.c_id','servicedetails_ar.company_id')
                                            ->join('subadmins_ar','subadmins_ar.company_id','companies_ar.c_id')
                                            ->where('subadmins_ar.s_a_email','=',Session::get('a_email'))
                                            ->where('services_ar.deleted_at','=',NULL)->get())}}
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">الخدمات الفرعية!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/services')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fas fa-puzzle-piece fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="huge navbar-left">
                                    @if(Session::get('subadmin') == "0")
                                        {{sizeof(DB::table('offers_ar')->where('deleted_at','=',NULL)->get())}}
                                    @else
                                        {{sizeof(DB::table('offers_ar')
                                            ->join('companies_ar','companies_ar.c_id','offers_ar.company_id')
                                            ->join('subadmins_ar','subadmins_ar.company_id','companies_ar.c_id')
                                            ->where('subadmins_ar.s_a_email','=',Session::get('a_email'))
                                            ->where('offers_ar.deleted_at','=',NULL)->get())}}
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                <div class="navbar-left">العروض!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{URL::to('ar/all/offers')}}">
                        <div class="panel-footer">
                            <span class="pull-right">عرض التفاصيل</span>
                            <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>--}}
        </div>
        <!-- /.row -->
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->
@endsection