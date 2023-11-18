<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin- Kaltim</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bk/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('bk/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('bk/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('bk/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    @stack('css_vendor')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bk/dist/css/adminlte.min.css')}}">
    @stack('css_cdn')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

        <!--Main Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
                @include('layouts.admin.b-nav')
            <!-- /.navbar -->

            <!-- Sidebar -->
                @include('layouts.admin.b-sidebar')
            <!-- End Sidebar -->

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @section('breadcrumb')
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            @show
                        </ol>
                      </div>
                    </div><!-- End Row -->
                  </div><!-- End Container Fluid -->
                </div>
                <!-- End Content Header -->

                <!-- Main Content -->
                <section class="content">
                  <div class="container-fluid">
                    @yield('content')
                  </div>
                </section>
                <!--End Main Content -->

            </div>
            <!-- End Content Wrapper -->

            <!-- Footer -->
                @include('layouts.admin.b-footer')
            <!-- End Footer -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
            <!-- End Control Sidebar -->

        </div>
        <!-- End Main Wrapper -->

        <!-- jQuery -->
        @include('layouts.admin.b-js')
        <!-- End Jquery -->

         <!-- Sweat Alert -->
         {{-- @include('sweetalert::alert') --}}
         <!-- End Sweat Alert -->

    </body>
</html>
