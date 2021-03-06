<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SV | Signin</title>
    <style>
        .form-signin
        {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading, .form-signin .checkbox
        {
            margin-bottom: 10px;
        }
        .form-signin .checkbox
        {
            font-weight: normal;
        }
        .form-signin .form-control
        {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .form-signin .form-control:focus
        {
            z-index: 2;
        }
        .form-signin input[type="text"]
        {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-signin input[type="password"]
        {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .account-wall
        {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .login-title
        {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }
        .profile-img
        {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        .need-help
        {
            margin-top: 10px;
        }
        .new-account
        {
            display: block;
            margin-top: 10px;
        }
        .rtl{direction: rtl}
    </style>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="container">
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
            <div class="alert alert-success">
                {{session()->get('insert_message')}}
            </div>
            <hr>
        @else <br><br><br><br><br><br>
        @endif
        <div class="row">
            <div style="width: 30px;height: 20px; background-color: #000000; margin-top: -100px;right: 0px">
                <a href="{{URL::to('/login')}}" class="text-center new-account">En </a>
            </div>
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">تسجيل الدخول</h1>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                         alt="">
                    <form class="form-signin" method="post" action="{{url('/login')}}">
                        {{csrf_field()}}
                        <input name="a_email" type="text" class="form-control rtl" placeholder="البريد الالكتروني" required autofocus>
                        <input name="a_password" type="password" class="form-control rtl" placeholder="كلمة المرور" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            تسجيل الدخول</button>
                        </form>
                    <a href="{{URL::to('/forget_password')}}" class="text-center new-account">نسيت كلمة المرور </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>