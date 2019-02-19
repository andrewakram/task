<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Task</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::to('adminp-ar/css/rtl/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- not use this in ltr -->
    <link href="{{URL::to('adminp-ar/css/rtl/bootstrap.rtl.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::to('adminp-ar/css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{URL::to('adminp-ar/css/plugins/timeline.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::to('adminp-ar/css/rtl/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{URL::to('adminp-ar/css/plugins/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    {{--<link href="{{URL::to('adminp-ar/css/font-awesome/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    {{--<link href="{{URL::to('adminp/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    --}}{{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('TimePicki/css/timepicki.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        button > i,a{color:#767676}
        th.prev, th.next {background: transparent;}
    </style>
    <style>
        @media (min-width: 768px) {
            .sidebar {
                width: 220px;
            }
            #page-wrapper{
                margin-right:220px;
            }
        }
        .rtl{direction: rtl}
    </style>
    <style>
        .nav>li>a {padding: 2px 15px;}
        /*.datepicker {direction: rtl}*/
        .datepicker-dropdown{
            width: fit-content;
            width: -moz-fit-content;
        }
    </style>
    <style>
        .table-responsive{
            height: 400px;
            width: 100%;
            display: block;
            overflow-x: scroll;
            overflow-y: scroll;
        }
    </style>
    {{--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>--}}
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="color:#973e41;font-size: x-large;" class="navbar-brand" href="{{URL::to('/ar')}}">
                    <b>

                    Task
                    </b>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-left">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php
                        $admins = DB::table('admins')->where('a_email','=',Session::get('a_email'))->get();
                        ?>
                        @foreach($admins as $admin)
                            <li>
                                @if(Session::get('subadmin') == "0")
                                    <a><i class="fa fa-user fa-fw"></i> {{$admin->a_name}}</a>
                                @else
                                    <a><i class="fa fa-user fa-fw"></i> {{$admin->c_name}}</a>
                                @endif
                            </li>
                        @endforeach
                        <li><a href="{{URL::to('/changeLanguae')}}"><i class="fas fa-cog"></i>&nbsp; الانجليزية </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> تسجيل الخروج</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <form method="get" action="{{url('/searchResult')}}">
                                {{csrf_field()}}
                                <div class="input-group custom-search-form">
                                    <input id="myInput" name="s" type="text" class="form-control" placeholder="بحث...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div>
                            </form>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="{{URL::to('/ar')}}"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
                        </li>
{{--

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> العملاء<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/users')}}">كل العملاء</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/user')}}">اضافة عميل جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> اماكن تواجد العملاء<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/locations')}}">كل الاحداثيات</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/location')}}">اضافة احداثي جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
--}}

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> الشركات<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/companies')}}">كل الشركات</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/company')}}">اضافة شركة جديدة</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> الموظفين <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/employees')}}">كل الموظفين</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/employee')}}">اضافة موظف جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
{{--

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>الخدمات الرئيسية<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/mainservices')}}">كل الخدمات الرئيسية</a>
                                </li>
                                @if(Session::get('subadmin') == "0")
                                    <li>
                                        <a href="{{URL::to('ar/add/mainservice')}}">اضافة خدمة جديدة</a>
                                    </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> الخدمات الفرعية<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/services')}}">كل الخدمات</a>
                                </li>
                                @if(Session::get('subadmin') == "0")
                                    <li>
                                        <a href="{{URL::to('ar/add/service')}}">اضافة خدمة جديدة</a>
                                    </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>خدمات الشركات<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/companyservices')}}">كل خدمات الشركات</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/companyservice')}}">اضافة خدمة للشركة</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> العروض<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/offers')}}">كل العروض</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/offer')}}">اضافة عرض جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> الطلبات<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/bookings')}}">كل الطلبات</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/booking')}}">اضافة طلب جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
--}}

                        {{--<li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> الطلبات الطارئة<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('ar/all/emergencybookings')}}">كل الطلبات الطارئة</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('ar/add/emergencybooking')}}">اضافة طلب طارئ جديد</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>--}}

                        {{--@if(Session::get('subadmin') == "0")
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> التقييم<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('ar/all/ratings')}}">كل التقييمات</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('ar/add/rating')}}">اضافة تقييم جديد</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> التعليقات<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('ar/all/comments')}}">كل التعليقات</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('ar/add/comment')}}">اضافة تعليق جديد</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> الشروط و الاحكام<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('ar/all/constraints')}}">كل الشروط</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('ar/add/constraint')}}">اضافة شرط جديد</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> معرض الصور<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/ar/all/gallaries')}}">كل الصور</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/ar/add/gallary')}}">اضافة صورة جديدة</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        @endif--}}

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    @yield('content_ar')

    @yield('add_company_ar')
    @yield('edit_company_ar')
    @yield('all_companies_ar')

    @yield('add_employee_ar')
    @yield('edit_employee_ar')
    @yield('all_employees_ar')

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="{{URL::to('adminp-ar/js/jquery-1.11.0.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::to('adminp-ar/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL::to('adminp-ar/js/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{URL::to('adminp-ar/js/raphael/raphael.min.js')}}"></script>
    <script src="{{URL::to('adminp-ar/js/morris/morris.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{URL::to('adminp-ar/js/sb-admin-2.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script type="text/javascript">
        $(document).on('click','#deletes',function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            bootbox.confirm(' Are you  sure to delete this record ?'  ,function (confirmed) {
                if(confirmed) {
                    window.location.href = link;
                }
            });
        });
    </script>
    <!-- **************** -->
    <script src="{{URL::to('adminp-ar/date-picker-ar.js')}}"></script>
    <script>
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $(function () {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                format : 'yyyy-mm-dd',
                startDate: today
            }).datepicker('update');
        });
    </script>
    <script src="{{URL::to('TimePicki/js/timepicki.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".time_element").timepicki();
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $('#selectUser').change(function(){
            var user_id = $(this).val();
            /*alert(user_id);*/
            if(user_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('/get/location')}}?user_id="+user_id,
                    success:function(res){
                        if(res){
                            $("#selectLocation").empty();
                            $("#selectLocation").append('<option value="" disabled selected>اختار الموقع</option>');
                            $.each(res,function(key,value){
                                $("#selectLocation").append('<option value="'+key+'" >'+value+'</option>');
                            });
                        }else{
                            $("#selectLocation").empty();
                        }
                    }
                });
            }else{
                $("#selectLocation").empty();
            }
        });
    </script>
    <script>
        $('#selectCompany').change(function(){
            var company_id = $(this).val();
            /*alert(company_id);*/
            if(company_id){

                $.ajax({
                    type:"GET",
                    url:"{{url('/get/service')}}?company_id="+company_id,
                    success:function(res){
                        if(res){
                            $("#selectService").empty();
                            $("#selectService").append('<option value="" disabled selected>اختار الخدمة</option>');
                            $.each(res,function(key,value){
                                $("#selectService").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#selectService").empty();
                        }
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('/get/offer')}}?company_id="+company_id,
                    success:function(res){
                        if(res){
                            $("#selectOffer").empty();
                            $("#selectOffer").append('<option value="" disabled selected>اختار عرض</option>');
                            $.each(res,function(key,value){
                                $("#selectOffer").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#selectOffer").empty();
                        }
                    }
                });
            }else{
                $("#selectService").empty();
            }
        });
    </script>
    <script>
        $('#selectMainService').change(function(){
            var mainservice_id = $(this).val();
            /*alert(mainservice_id);*/
            if(mainservice_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('/get/services')}}?mainservice_id="+mainservice_id,
                    success:function(res){
                        if(res){
                            console.log(res);
                            $("#selectService").empty();
                            $.each(res,function(key,value){
                                $("#selectService").append('<option value="'+key+'" >'+value+'</option>');
                            });
                        }
                        if(res.length === 0){
                            $("#selectService").empty();
                        }
                    }
                });
            }else{
                $("#selectService").empty();
            }
        });
    </script>
</body>
</html>
