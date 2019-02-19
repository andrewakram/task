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
    <link href="{{URL::to('adminp/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{URL::to('adminp/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::to('adminp/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{URL::to('adminp/vendor/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{URL::to('adminp/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('TimePicki/css/timepicki.css')}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- styles for datepicker -->
    <style>
        .table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: transparent;
        }
    </style>
    <style>
        button > i,a{color:#767676}
        th.prev, th.next {background: transparent;}
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
    <style>
        @media (min-width: 768px) {
            .sidebar {
                width: 220px;
            }
            #page-wrapper{
                margin-left:220px;
            }
        }
    </style>
    <style>
        .nav>li>a {padding: 2px 15px;}
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
                <a style="color:#973e41;font-size: x-large;" class="navbar-brand" href="{{URL::to('/')}}">
                    <b>

                        Task
                    </b>
                </a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
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
                        <li><a href="{{URL::to('/changeLanguae')}}"><i class="fa fa-gear fa-fw"></i> Arabic</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                    <input type="text" name="s" id="myInput" class="form-control" placeholder="Search...">
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
                            <a href="{{URL::to('/')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        {{--<li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/users')}}">All Users</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('add/user')}}">Add New User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>--}}

                        {{--<li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Users Locations<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/locations')}}">All Locations</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('add/location')}}">Add New Location</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>--}}

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Companies<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('/all/companies')}}">All Companies</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/add/company')}}">Add New Company</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Employees <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/employees')}}">All Employees</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('add/employee')}}">Add New Employee</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        {{--<li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>Main Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/mainservices')}}">All Main Services</a>
                                </li>
                                @if(Session::get('subadmin') == "0")
                                    <li>
                                        <a href="{{URL::to('add/mainservice')}}">Add New Main Service</a>
                                    </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/services')}}">All Services</a>
                                </li>
                                @if(Session::get('subadmin') == "0")
                                    <li>
                                        <a href="{{URL::to('add/service')}}">Add New Service</a>
                                    </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Company Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/companyservices')}}">All Company Services</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('add/companyservice')}}">Add Service to Company</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Offers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('all/offers')}}">All Offers</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('add/offer')}}">Add New Offer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Orders<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('/all/bookings')}}">All Orders</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/add/booking')}}">Add New Order</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>Emergency Orders<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('/all/emergencybookings')}}">All Emergency Orders</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/add/emergencybooking')}}">Add New Emergency Order</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        @if(Session::get('subadmin') == "0")
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Ratings<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/all/ratings')}}">All Ratings</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/add/rating')}}">Add New Rating</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Comments<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/all/comments')}}">All Comments</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/add/comment')}}">Add New Comment</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Constraints<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('all/constraints')}}">All Constraints</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/add/constraint')}}">Add New Constraint</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Gallery<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/all/gallaries')}}">All Photos</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('/add/gallary')}}">Add New Photo</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        @endif
--}}
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @yield('content')

        @yield('add_company')
        @yield('edit_company')
        @yield('all_companies')

        @yield('add_employee')
        @yield('edit_employee')
        @yield('all_employees')

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{URL::to('adminp/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::to('adminp/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL::to('adminp/vendor/metisMenu/metisMenu.min.js')}}"></script>
    <!-- Morris Charts JavaScript -->
    <script src="{{URL::to('adminp/vendor/raphael/raphael.min.js')}}"></script>
    {{--<script src="{{URL::to('adminp/vendor/morrisjs/morris.min.js')}}"></script>--}}
    {{--<script src="{{URL::to('adminp/data/morris-data.js')}}"></script>--}}
    <!-- Custom Theme JavaScript -->
    <script src="{{URL::to('adminp/dist/js/sb-admin-2.js')}}"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
                            $("#selectLocation").append('<option value="" disabled selected>Choose Location</option>');
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
                            $("#selectService").append('<option value="" disabled selected>Choose Service</option>');
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
                            $("#selectOffer").append('<option value="" disabled selected>Choose Offer</option>');
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