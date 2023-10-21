<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/toastr/toastr.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/backend/dist/css/adminlte.min.css') }}">
    <style>
        @media (min-width: 768px){
            .col-form-label{
                text-align: right;
            }
        }

        .form-group.has-error label {
            color: #dd4b39;
        }
        .form-group.has-error .form-control, .form-group.has-error .input-group-addon {
            border-color: #dd4b39;
            box-shadow: none;
        }
        .form-group.has-error .help-block {
            color: #dd4b39;
        }
        .help-block {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .toast{
            min-width: 300px;
        }
        .select2{
            width: 100% !important;
        }
        .form-group.has-error .select2-container span.selection span.select2-selection.select2-selection--single {
            border-color: #dd4b39;
            box-shadow: none;
        }
        .input-group.date-time.has-error .form-control {
            border-color: #dd4b39;
            box-shadow: none;
        }

        .input-group.date-time.has-error > .help-block {
            color: #dd4b39;
        }
        .content-header h1 {
            font-size: 1.5rem;
        }
        .content-header {
            padding: 5px .5rem;
        }
        .brand-link {
            line-height: 1.9;
        }


        .nav-link {
            padding: .5rem .5rem;
        }
        body{
            overflow-x: hidden;
        }
        a.brand-link {
            padding: 9px 0;
        }
        .brand-link .brand-image {
            margin-top: 3px;
        }
        .table-attribute{
            padding-left: 10px;
        }
        body {

            position: relative;
        }

        div#ajax-loading {
            position: fixed;
            z-index: 9999;
            background: #00000082;
            top: 0;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        div#ajax-loading img {
            margin-top: 300px;
        }
    </style>
    @yield('style')
</head>
<body class="sidebar-mini">
<div id="ajax-loading" style="display: none">
    <img src="{{ asset('img/loading.gif') }}" alt="">
</div>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <h3  class="nav-link font-weight-bold active" style="color: #ffffff;font-size: 22px;margin: 0">{{ config('app.name') }}</h3>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img height="30" class="img-circle" src="{{ asset('themes/backend/dist/img/user2-160x160.jpg') }}" alt=""> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="{{ route('admin.logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('img/logo-trans.png') }}" alt="" class="brand-image elevation-3" style="">
            <span class="brand-text font-weight-light"><b>Admin</b>Panel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">

            <!-- Sidebar Menu -->
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php
                    $subMenu = [
                        'warehouse','warehouse.add','warehouse.edit',
                        'delivery_option','delivery_option.add','delivery_option.edit',
                        ];
                    ?>
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $subMenu) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list-ul"></i>
                            <p>
                                Administrator
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('warehouse') }}" class="nav-link {{ Route::currentRouteName() == 'warehouse' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Warehouse</p>
                                </a>
                            </li>
                            <?php
                            $subSubMenu = [
                                'delivery_option','delivery_option.add','delivery_option.edit',
                            ];
                            ?>
                            <li class="nav-item">
                                <a href="{{ route('delivery_option') }}" class="nav-link {{ in_array(Route::currentRouteName(), $subSubMenu) ? 'active' : ''  }}">
                                    <i class="far {{ in_array(Route::currentRouteName(), $subSubMenu) ? 'fa-check-circle' : 'fa-circle'  }} nav-icon"></i>
                                    <p>Delivery Option</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php
                        $subMenu = ['video','video.add','video.edit'];
                    ?>
                    <li class="nav-item">
                        <a href="{{ route('video') }}" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-video"></i>
                            <p>Video/Photo</p>
                        </a>
                    </li>
                    <?php
                    $subMenu = [
                        'unit','unit.add','unit.edit',
                        'brand','brand.add','brand.edit',
                        'collection','collection.add','collection.edit',
                        'category','category.add','category.edit',
                        'sub_category','sub_category.add','sub_category.edit',
                        'sub_sub_category','sub_sub_category.add','sub_sub_category.edit',
                        'color','color.add','color.edit',
                        'size','size.add','size.edit',
                        'type','type.add','type.edit',
                        'product','product.add','product.edit',
                        'view_by_look_product','view_by_look_product.add','view_by_look_product.edit',
                        ];
                    ?>

                    <li class="nav-item {{ in_array(Route::currentRouteName(), $subMenu) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list-ul"></i>
                            <p>
                                Manage Product
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('unit') }}" class="nav-link {{ Route::currentRouteName() == 'unit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Unit</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('category') }}" class="nav-link {{ Route::currentRouteName() == 'category' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sub_category') }}" class="nav-link {{ Route::currentRouteName() == 'sub_category' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sub_sub_category') }}" class="nav-link {{ Route::currentRouteName() == 'sub_sub_category' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand') }}" class="nav-link {{ Route::currentRouteName() == 'brand' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('color') }}" class="nav-link {{ Route::currentRouteName() == 'color' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Color</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('size') }}" class="nav-link {{ Route::currentRouteName() == 'size' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Size</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('type') }}" class="nav-link {{ Route::currentRouteName() == 'type' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('collection') }}" class="nav-link {{ Route::currentRouteName() == 'collection' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Collection</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product') }}" class="nav-link {{ Route::currentRouteName() == 'product' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('view_by_look_product') }}" class="nav-link {{ Route::currentRouteName() == 'view_by_look_product' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View By Look Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                          <?php
                    $subMenu = [
                        'magazine_category','magazine_category.add','magazine_category.edit',
                        'magazine','magazine.add','magazine.edit',
                    ];
                    ?>
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $subMenu) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-warehouse"></i>
                            <p>
                                Manage Magazine
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php
                            $subSubMenu = ['magazine_category','magazine_category.add','magazine_category.edit'];
                            ?>
                            <li class="nav-item">
                                <a href="{{ route('magazine_category') }}" class="nav-link {{ in_array(Route::currentRouteName(),$subSubMenu) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <?php
                                $subSubMenu = ['magazine','magazine.add','magazine.edit'];
                            ?>
                            <li class="nav-item">
                                <a href="{{ route('magazine') }}" class="nav-link {{ in_array(Route::currentRouteName(),$subSubMenu) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Magazine</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <?php
                   $subMenu = ['finished_goods','finished_goods.add','inventory','inventory_log'];
                    ?>
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $subMenu) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-warehouse"></i>
                            <p>
                                Manage Inventory
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('finished_goods.add') }}" class="nav-link {{ Route::currentRouteName() == 'finished_goods.add' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Finished Goods</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('finished_goods') }}" class="nav-link {{ Route::currentRouteName() == 'finished_goods' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Finished Goods Log</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory') }}" class="nav-link {{ Route::currentRouteName() == 'inventory' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inventory</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    $subMenu =['order.pending','order.approved','order.processing',
                        'order.return_initiate',
                        'order.returned',
                        'order.on_shipping','order.shipped', 'order.delivered',
                        'order.view'];
                    ?>
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $subMenu) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list-ul"></i>
                            <p>
                                Manage Order
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('order.processing') }}" class="nav-link {{ Route::currentRouteName() == 'order.processing' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Processing <label class="badge badge-info">{{ $layoutData['processingOrders'] }}</label></p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('order.shipped') }}" class="nav-link {{ Route::currentRouteName() == 'order.shipped' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Shipped <label class="badge badge-info">{{ $layoutData['shippedOrders'] }}</label></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('order.delivered') }}" class="nav-link {{ Route::currentRouteName() == 'order.delivered' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Delivered <label class="badge badge-success">{{ $layoutData['deliveredOrders'] }}</label></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('order.returned') }}" class="nav-link {{ Route::currentRouteName() == 'order.returned' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Returned <label class="badge badge-danger">{{ $layoutData['returnedOrders'] }}</label></p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php
                    $subMenu =[
                        'faq_question','faq_question.add','faq_question.edit',
                    ];
                    ?>
                    <li class="nav-item">
                        <a href="{{ route('faq_question') }}" class="nav-link {{ Route::currentRouteName() == 'faq_question' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>FAQ</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0"> @yield('title') </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Design & Developed By <a target="_blank" href="https://2aitbd.com">2A IT LIMITED</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022-{{ date('Y') }} <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('themes/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('themes/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('themes/backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('themes/backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('themes/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('themes/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('themes/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('themes/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('themes/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('themes/backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('themes/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('themes/backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script src="{{ asset('themes/backend/dist/js/sweetalert2@9.js') }}"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var message = '{{ session('message') }}';
        var error = '{{ session('error') }}';

        if (!window.performance || window.performance.navigation.type != window.performance.navigation.TYPE_BACK_FORWARD) {
            if (message != '')
                $(document).Toasts('create', {
                    icon: 'fas fa-envelope fa-lg',
                    class: 'bg-success',
                    title: 'Success',
                    autohide: true,
                    delay: 2000,
                    body: message
                })

            if (error != '')
                $(document).Toasts('create', {
                    icon: 'fas fa-envelope fa-lg',
                    class: 'bg-danger',
                    title: 'Error',
                    autohide: true,
                    delay: 2000,
                    body: error
                })
        }


    });
</script>

<script>
    $(function () {

        //Date picker
        $('.date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm-dd-yyyy', { 'placeholder': 'mm-dd-yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('.date-time').datetimepicker({
            format: 'DD-MM-YYYY hh:mm A',
            icons: { time: 'far fa-clock' }
        });
        //Date and time picker
        $('.date,.start_date,.end_date').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM-DD-YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },function (start, end) {
                $('#daterange-btn').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#to_date').val(start.format('YYYY-MM-DD'));
                $('#from_date').val(end.format('YYYY-MM-DD'));

            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker();
        //color picker with addon
        $('.my-colorpicker2').colorpicker();
        $('.my-colorpicker3').colorpicker();

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        // Summernote
        $('#text-editor').summernote();

    })
</script>
@yield('script')
<!-- AdminLTE App -->
<script src="{{ asset('themes/backend/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
