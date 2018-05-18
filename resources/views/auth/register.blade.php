<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon/favicon.png')}}">
        <title>{{config("app.name")}} | Регистрация</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset("plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(img/background/medicina.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{ route('register') }}" method="POST">
                    @csrf
                    <a href="javascript:void(0)" class="text-center db"><img src="{{asset('img/logo/logo.png')}}" alt="Home" /><br/>КГБУЗ Городская больница №10</a>
                    <h3 class="box-title m-t-40 m-b-0">Зарегистрироваться сейчас</h3><small>Создайте свою учетную запись</small>
                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required="" placeholder="Ф.И.О.">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="login" value="{{ old('login') }}" required="" placeholder="Логин">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Пароль">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Повторите пароль">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Зарегистрироваться</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>У вас уже есть учетная запись? <a href="{{route('login')}}" class="text-info m-l-5"><b>Войти</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    {{--<script src="js/sidebarmenu.js"></script>--}}
    <!--stickey kit -->
    {{--<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>--}}
    {{--<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>--}}
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    {{--<script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>--}}
    </body>

</html>
