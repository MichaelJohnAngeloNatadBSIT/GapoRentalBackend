<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gapo Rental</title>

  <link rel="icon" type="image/x-icon"  href="{{asset("/assets/logo/gapo-rental-logo.jpg")}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}
    <style>
        #logo{
            height: 150px;
            width: 150px;
            border-radius: 80px;
        }
    </style>
</head>
<body class="hold-transition register-page">

    {{-- @include('sweet::alert') --}}
    @include('sweetalert::alert')
    @yield('content')




     <!-- jQuery -->
     <script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
     <!-- Bootstrap 4 -->
     <script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
     <!-- AdminLTE App -->
     <script src="{{asset("assets/dist/js/adminlte.min.js")}}"></script>
</body>


