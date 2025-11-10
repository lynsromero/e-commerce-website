<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('admin-panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />


    <!-- Custom Theme Style -->
    <link href="{{ asset('admin-panel/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fas fa-utensils"></i> <span>{{ env('APP_NAME') }}</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('storage/avatar.jpg') }}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('admin-panel.layouts.sidebar')
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <i class="fa-solid fa-expand"></i>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <i class="fa-solid fa-eye-slash"></i>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>

                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            @include('admin-panel.layouts.navbar')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                @yield('content')

                <!-- /page content -->
            </div>
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>

        <!-- jQuery -->
        <script src="{{ asset('admin-panel/js/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('admin-panel/js/bootstrap.min.js') }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('admin-panel/js/custom.min.js') }}"></script>

        @stack('scripts')

</body>

</html>
