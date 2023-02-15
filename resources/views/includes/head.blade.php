


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORCA | Administration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Data table -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- Power table -->
    <link rel="stylesheet" href="{{ asset('css/powertable.css') }}">

    <!--- Jquery.JqGrid --->
    <link rel="stylesheet" href="{{ asset('jqGrid/css/ui.jqgrid.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.8.0/css/ui.jqgrid.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqgrid/5.4.0/css/ui.jqgrid-bootstrap.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('css/bs-toggle.css')}}">
    <link rel="stylesheet" href="{{asset('css/choose-color.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min-3.6.1.js') }}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('js/bs-toggle.js')}}"></script>
    <script src="{{asset('js/choose-color.js')}}"></script>
    <script src="{{ asset('js/jQuery.print-1.2.js') }}"></script>
<style>
    @font-face {
        font-family: Inter-Bold;
        src: url('/fonts/inter/Inter-Bold.ttf');
    }
    @font-face {
        font-family: Inter-Extra-Bold;
        src: url('/fonts/inter/Inter-ExtraBold.ttf');
    }
    @font-face {
        font-family: Inter-Medium-Bold;
        src: url('/fonts/inter/Inter-MediumBold.ttf');
    }
    @font-face {
        font-family: Inter-Italic;
        src: url('/fonts/inter/Inter-Italic.ttf');
    }
    @font-face {
        font-family: Inter-Black;
        src: url('/fonts/inter/Inter-Black.ttf');
    }
    aside .nav-pills .nav-link {
        color: #303030;
    }

    .sidebar-dark-primary .nav-sidebar > .nav-item.active{
        background-color: #303030;
        color: #ffffff;
    }
    .sidebar-dark-primary .nav-sidebar > .nav-item.active>.nav-link{
        color: #ffffff;
    }

    [class*="sidebar-dark-"] .nav-sidebar > .nav-item:hover{
        color: #bbbbbb;
        background-color: #303030;
    }
    [class*="sidebar-dark-"] .nav-sidebar > .nav-item.menu-open > .nav-link, [class*="sidebar-dark-"] .nav-sidebar > .nav-item:hover > .nav-link {
        background-color: #303030;
    }
    [class*="sidebar-dark-"] {
    background-color: #ffffff;
    }
    [class*="sidebar-dark"] .brand-link {
        border-bottom: none;
    }
    .nav-sidebar > .nav-item {
        margin-bottom: 0;
        border-bottom: 1px solid #bbbbbb;
    }
    [class*="sidebar-dark"] .brand-link, [class*="sidebar-dark"] .brand-link .pushmenu {
        color: #303030;
    }
    [class*="sidebar-dark"] .brand-link:hover{
        color: #ffffff;
        background-color: #303030;
    }
</style>
</head>
